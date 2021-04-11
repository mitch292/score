<?php

namespace App\Services;

use Closure;
use Carbon\Carbon;
use App\Models\Team;
use App\Models\Game;
use App\Models\Player;
use App\Models\Highlight;
use Illuminate\Support\Collection;
use Laravel\Octane\Facades\Octane;
use App\Classes\Mlb\ApiClient\Client;
use App\Classes\Mlb\ApiClient\DataObjects\Game as GameDataObject;
use App\Classes\Mlb\ApiClient\DataObjects\Score as ScoreDataObject;


class MlbService
{
	private Client $client;

	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	/**
	 * Get the scheduled games for the date as a Collection
	 * 
	 * @param Carbon $date
	 * @return Collection
	 */
	public function getGamesForDate(Carbon $date): Collection
	{
		// TODO: handle the exception thrown here
		$schedule = $this->client->schedule()->getSchedule($date->toDateString());

		if (empty($schedule->getFirstDate())) {
			return collect([]); // TODO: should we throw an exception to handle?
		}

		$games = $schedule->getFirstDate()->getGames();
		$scores = $this->getScoreDataforGames($games);

		$zipped = collect($games)->zip($scores);
		
		$this->saveGames($zipped);

		return $zipped->map(function($game) {
			[$gameData, $scoreData] = $game;
			return $this->formatGame($gameData, $scoreData);
		});
	}

	// TODO: Can I remove this?
	public function getPersistedGamesFromExtId($gamePks): Collection
	{
		$collection = collect($gamePks)->map(function($gamePk) {
			$game = Game::where("external_id", $gamePk);
			return $this->formatGame($game->schedule_data, $game->score_data);
		});

		return $collection;
	}

	/**
	 * Get the highlights for a given external game pk 
	 * 
	 * @param string|int $gamePk
	 * @return Collection
	 */
	public function getHighlightsForGame(string|int $gamePk): Collection
	{
		$data = $this->client->highlights()->getHighlights($gamePk);

		// TODO: Error Handling here and use case where game is live (data->getLive...)
		// TODO: maybe this save highlights should be in a separate function
		$highlights = array_map(function($highlight) use($gamePk) {
			return Highlight::firstOrCreate(
				[
					'external_id' => $highlight->getMediaPlaybackId(),
				],
				[
					'playback_url' => $highlight->getFirstPlayback()->getUrl(),
					'title' => $highlight->getHeadline(),
					'description' => $highlight->getDescription(),
					'game_id' => Game::where('external_id', $gamePk)->first()->id,
				],
			);
		}, $data->getHighlights()->getItems());

		return collect($highlights);
	}

	/**
	 * Save the mlb games to the database.
	 * 
	 * @param Collection $games - [[GameDataObject, ScoreDataObject]]
	 * @return void
	 */
	private function saveGames(Collection $games): void
	{
		// TODO: run concurrently via Octane
		$games->map(function($game) {
			[$gameData, $scoreData] = $game;
			Game::updateOrCreate(
				[
					"external_id" => $gameData->getGamePk(),
				],
				[
					"schedule_data" => $gameData,
					"score_data" => $scoreData,
				],
			);
		});
	}

	/**
	 * Get the game score or boxscore like data for a set of games.
	 * 
	 * @param GameDataObject[] $games
	 * @return ScoreDataObject[]
	 */
	public function getScoreDataforGames(array $games): array
	{
		return array_map(fn ($game) => $this->fetchgameData($game->getGamePk()), $games);
	}

	/**
	 * Get the score data for a given game id.
	 * 
	 * @param string|int $gameId
	 * @return ScoreDataObject
	 */
	private function fetchGameData(string|int $gameId): ScoreDataObject
	{
		$gameData = $this->client->score()->getScore($gameId); // TODO: catch exception

		return $gameData;
	}

	/**
	 * Format and summarize game and score data into an associated array
	 * 
	 * @param GameDataObject $game
	 * @param ScoreDataObject $score
	 * @return array
	 */
	private function formatGame(GameDataObject $game, ScoreDataObject $score): array
	{
		$gameData = $score->getGameData();
		$probablePitcherHome = $gameData->getProbablePitchers()->getHome();
		$probablePitcherAway = $gameData->getProbablePitchers()->getAway();

		if (!empty($probablePitcherHome) && !empty($probablePitcherAway)) {
			[$homePitcher, $awayPitcher] = Octane::concurrently([
				$this->getPlayerDetails($probablePitcherHome->getId()),
				$this->getPlayerDetails($probablePitcherAway->getId()),
			]);
		}

		return [
			'gamePk' => $game->getGamePk(),
			'link' => $game->getLink(),
			'date' => Carbon::createFromFormat('Y-m-d\TH:i:s\Z', $game->getGameDate()),
			'status' => $game->getStatus(),
			'teams' => $gameData->getTeams()->toArray(),
			'pitchers' => [
				'home' => $homePitcher ?? null,
				'away' => $awayPitcher ?? null,
			],
			'weather' => $gameData->getWeather()->toArray(),
			'datetime' => $gameData->GetDatetime()->toArray(),
			'linescore' => $score->getLiveData()->getLinescore()->toArray(),
			'scoreData' => [
				'home' => Team::where('external_id', $gameData->getTeams()->getHome()->getId())->first(),
				'away' => Team::where('external_id', $gameData->getTeams()->getAway()->getId())->first(),
			]
		];
	}

	/**
	 * Get player details for a given external id
	 * 
	 * @param string|int $externalPlayerId
	 * @return Closure
	 */
	public function getPlayerDetails(string|int $externalPlayerId): Closure
	{
		$player = Player::where('external_id', $externalPlayerId)->first();
		
		if (empty($player)) {

			$person = $this->client->people()->getPerson($externalPlayerId); // TODO: Catch PlayerException

			$player = Player::create([
				'external_id' => $person->getExternalId(),
				'first_name' => $person->getFirstName(),
				'last_name' => $person->getLastName(),
				'full_name' => $person->getFullName(),
				'birth_city' => $person->getBirthCity(),
				'birth_state_province' => $person->getBirthStateProvince(),
				'birth_country' => $person->getBirthCountry(),
			]);
		}

		// Since this function is run conncurrently in Octane/Swool, return a Closure
		return fn () => $player;
	}
}