<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class GameTeams extends BaseDataObject
{
	private GameTeam $away;
	private GameTeam $home;

	public function __construct(array $data) {
		$this->away = new GameTeam($data["away"]);
		$this->home = new GameTeam($data["home"]);
	}

	public function getAway(): GameTeam
	{
		return $this->away;
	}

	public function getHome(): GameTeam
	{
		return $this->home;
	}
}