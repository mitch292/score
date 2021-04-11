<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class ScoreTeams extends BaseDataObject
{
	private ScoreTeam $away;
	private ScoreTeam $home;

	public function __construct(array $data) {
		$this->away = new ScoreTeam($data["away"]);
		$this->home = new ScoreTeam($data["home"]);
	}

	public function getAway(): ScoreTeam
	{
		return $this->away;
	}

	public function getHome(): ScoreTeam
	{
		return $this->home;
	}
}