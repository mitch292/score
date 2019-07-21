<?php

namespace App\Http\Controllers\Mlb;

use Illuminate\Http\Request;
use App\ApiClients\MlbGameApiClient;
use App\ApiClients\MlbApiClient;


class GameController extends BaseController
{
	public function __construct()
	{
		$this->mlbGameApi = new MlbGameApiClient();
		$this->mlbApi = new MlbApiClient();
	}

	public function fetchGameData($gameId)
	{
		$gameData = $this->mlbGameApi->fetchGameData($gameId);

		return $this->sanitizeGame(json_decode($gameData));

	}

	private function sanitizeGame($game)
	{
		return [
			'pitchers' => [
				'home' => $this->mlbApi->fetchPlayerDetails($game->gameData->probablePitchers->home->id),
				'away' => $this->mlbApi->fetchPlayerDetails($game->gameData->probablePitchers->away->id),
			],
			'weather' => $game->gameData->weather,
			'datetime' => $game->gameData->datetime,
			'linescore' => $game->liveData->linescore,
			'boxscore' => $game->liveData->boxscore,
		];
	}
}
