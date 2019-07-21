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

		\Debugbar::addMessage('hello');
		\Debugbar::info($gameData);
		return $gameData;

	}

	private function sanitizeGame($game)
	{
		\Debugbar::info($game);
		$this->mlbApi->fetchPlayerDetails($game->gameData->probablePitchers->away->id);
		// $game = [
		// 	'pitchers' => [
		// 		'home' => 
		// 	]
		// ]
	}
}
