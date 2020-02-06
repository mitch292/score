<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Carbon\Carbon;
use App\Http\Clients\MlbClient;
use App\Models\Team;
use App\Models\Player;
use App\Models\Highlight;
use App\Models\Game;


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

	public function __construct(MlbClient $mlbClient, MlbClient $mlbGameClient)
	{
		$this->mlbClient = $mlbClient;
		$this->mlbGameClient = $mlbGameClient;
	}

	public function fetchGamesForDate($date): Collection
    {
        $response = $this->mlbClient->get('schedule', [
            'query' => [
                'sportId' => 1,
                'date' => $date

            ]
        ]);

		$data = json_decode((string) $response->getBody(), true);
		
		if (empty($data['dates'])) {
			return collect([]);
		}

		$collection = collect($data['dates'][0]['games'])->map(function ($game) {
			return $this->formatGame($game);
		});

        return $collection;
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

	
	private function formatGame($game): Array
	{
		$extraData = $this->fetchGameData($game['gamePk']);
		$homePitcher = $this->getPlayerDetails($extraData['gameData']['probablePitchers']['home']['id']);
		$awayPitcher = $this->getPlayerDetails($extraData['gameData']['probablePitchers']['away']['id']);


		return [
			'gamePk' => $game['gamePk'],
			'link' => $game['link'] ?? null,
			'date' => !empty($game['gameDate']) 
				? Carbon::createFromFormat('Y-m-d\TH:i:s\Z', $game['gameDate'])
				: null,
			'status' => $game['status'] ?? null,
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

	private function getPlayerDetails($externalPlayerId): Player
	{
		$player = Player::where('external_id', $externalPlayerId)->first();

		if (empty($player)) {

			$response = $this->mlbClient->get('people/'.$externalPlayerId);

			$data = json_decode((string) $response->getBody(), true);

			
			if (empty($data['people'])) {
				[];
			}
			$player = Player::create(
				Player::formatPlayer($data['people'][0])
			);
		}

		return $player;
	}

	
}