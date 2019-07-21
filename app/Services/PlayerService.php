<?php

namespace App\Services;

use App\ApiClients\MlbApiClient;
use App\Models\Player;

class PlayerService
{

	public function __construct()
	{
		$this->mlbApi = new MlbApiClient();
	}

	// expected that playerId is mlb data player id
	public function get($playerId)
	{
		$player = Player::where('external_id', $playerId)->first();

		if (empty($player)) {
			$player = Player::create(Player::formatPlayer($this->mlbApi->fetchPlayerDetails($playerId)));
		}

		return $player;
	}

}
