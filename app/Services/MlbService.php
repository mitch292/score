<?php

namespace App\Services;

use Closure;
use Carbon\Carbon;
use App\Models\Team;
use App\Models\Game;
use App\Models\Player;
use App\Models\Highlight;
use App\Http\Clients\MlbClient;
use Illuminate\Support\Collection;
use Laravel\Octane\Facades\Octane;
use App\Classes\Mlb\ApiClient\Client;
use App\Classes\Mlb\ApiClient\DataObjects\Game as GameDataObject;


class MlbService
{
	/**
	 * @var MlbClient
	 */
	private $mlbClient;

	/**
	 * @var MlbClient
	 */
	private $mlbGameClient;

	private Client $client;

	public function __construct(MlbClient $mlbClient, MlbClient $mlbGameClient)
	{
		// TODO: Complete refactoring to new client then move this to service provider
		$this->client = new Client(config('services.mlb.api_base_url'), config('services.mlb.game_api_base_url'));

		$this->mlbClient = $mlbClient;
		$this->mlbGameClient = $mlbGameClient;
	}

	public function fetchGamesForDate(Carbon $date): Collection
	{
		$schedule = $this->client->schedule()->getSchedule($date->toDateString());

		if (empty($schedule->getFirstDate())) {
			return collect([]); // TODO: should we throw an exception to handle?
		}

		return collect($schedule->getFirstDate()->getGames())
			->map(fn($game) => $this->formatGame($game));
	}

	public function fetchGamesFromIds($gamePks): Collection
	{
		$collection = collect($gamePks)->map(function($gamePk) {
			return $this->formatGame([
				'gamePk' => $gamePk
			]);
		});

		return $collection;
	}

	public function fetchHighlights($gamePk): Collection
	{
		$response = $this->mlbClient->get('game/'.$gamePk.'/content');
		
		// TODO: Error Handling here and use case where game is live (highlights->live...)
		$data = json_decode((string) $response->getBody(), true);

		if (empty($data['highlights'])) {
			return [];
		}

		$collection = collect($data['highlights']['highlights']['items'])->map(function ($highlight) use($gamePk) {
			return Highlight::firstOrCreate(['external_id' => $highlight['mediaPlaybackId']], [
				'playback_url' => $highlight['playbacks'][0]['url'],
				'title' => $highlight['headline'],
				'description' => $highlight['description'],
				'game_id' => Game::firstOrCreate(['external_id' => $gamePk])->id,
			]);
		});

		return $collection;
	}

	
	/***********************************************************************************************************************
	 * 
	 * PRIVATE FUNCTIONS
	 * 
	 ***********************************************************************************************************************/

	
	private function formatGame(GameDataObject $game): array
	{
		$extraData = $this->fetchGameData($game->getGamePk());
		
		[$homePitcher, $awayPitcher] = Octane::concurrently([
			$this->getPlayerDetails($extraData['gameData']['probablePitchers']['home']['id']),
			$this->getPlayerDetails($extraData['gameData']['probablePitchers']['away']['id']),
		]);

		return [
			'gamePk' => $game->getGamePk(),
			'link' => $game->getLink(),
			'date' => Carbon::createFromFormat('Y-m-d\TH:i:s\Z', $game->getGameDate()),
			'status' => $game->getStatus(),
			'teams' => $extraData['gameData']['teams'],
			'pitchers' => [
				'home' => $homePitcher,
				'away' => $awayPitcher,
			],
			'weather' => $extraData['gameData']['weather'],
			'datetime' => $extraData['gameData']['datetime'],
			'linescore' => $extraData['liveData']['linescore'],
			'boxscore' => $extraData['liveData']['boxscore'],
			'scoreData' => [
				'home' => Team::where('external_id', $extraData['gameData']['teams']['home']['id'])->first(),
				'away' => Team::where('external_id', $extraData['gameData']['teams']['away']['id'])->first(),
			]


		];
	}
	
	private function fetchGameData($gameId): Array
	{
		$requestUri = 'game/'.$gameId.'/feed/live';

		$response = $this->mlbGameClient->get($requestUri);
		
		$data = json_decode((string) $response->getBody(), true);
		
		if (empty($data)){
			return [];
		}

		return $data;
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
				'birth_state_province' => $person->getBirthStateProvince,
				'birth_country' => $person->getBirthCountry(),
			]);

		}

		// Since this function conncurrently in Octane/Swool, return a Closure
		return fn () => $player;
	}
}