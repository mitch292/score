<?php

namespace App\Http\Controllers\Mlb;

use Illuminate\Http\Request;
use App\ApiClients\MlbGameApiClient;
use App\ApiClients\MlbApiClient;
use App\Models\Player;


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
				'home' => $this->getPlayer($game->gameData->probablePitchers->home->id),
				'away' =>$this->getPlayer($game->gameData->probablePitchers->away->id),
			],
			'weather' => $game->gameData->weather,
			'datetime' => $game->gameData->datetime,
			'linescore' => $game->liveData->linescore,
			'boxscore' => $game->liveData->boxscore,
		];
	}

	// This should probably be abstracted out to somewhere else
	private function getPlayer($playerId)
	{
		$player = Player::where('external_id', $playerId)->first();

		if (empty($player)) {
			$player = Player::create(Player::formatPlayer($this->mlbApi->fetchPlayerDetails($playerId)));
		}

		return $player;
	}
}
