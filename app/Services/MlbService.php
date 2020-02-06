<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Carbon\Carbon;
use App\Http\Clients\MlbClient;
use App\Models\Team;

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

	private function formatGame($game): Array
	{
		$extraData = $this->fetchGameData($game['gamePk']);

		return [
			'gamePk' => $game['gamePk'],
			'link' => $game['link'],
			'date' => Carbon::createFromFormat('Y-m-d\TH:i:s\Z', $game['gameDate']),
			'status' => $game['status'],
			'teams' => $extraData['gameData']['teams'],
			'pitchers' => [
				'home' => [
					$extraData['gameData']['probablePitchers']['home']['id']
				],
				'away' => [
					$extraData['gameData']['probablePitchers']['away']['id']
				],
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

	
}