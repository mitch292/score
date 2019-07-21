<?php

namespace App\Services;

use App\ApiClients\MlbGameApiClient;
use App\Services\PlayerService;

class GameService
{

	public function __construct()
	{
        $this->mlbGameApi = new MlbGameApiClient();
        $this->player = new PlayerService();
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
				'home' => $this->player->get($game->gameData->probablePitchers->home->id),
				'away' =>$this->player->get($game->gameData->probablePitchers->away->id),
			],
			'weather' => $game->gameData->weather,
			'datetime' => $game->gameData->datetime,
			'linescore' => $game->liveData->linescore,
			'boxscore' => $game->liveData->boxscore,
		];
	}

}
