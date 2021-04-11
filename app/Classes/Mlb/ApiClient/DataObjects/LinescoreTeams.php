<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class LinescoreTeams extends BaseDataObject
{
	private LinescoreSummary $away;
	private LinescoreSummary $home;

	public function __construct(array $data) {
		$this->away = new LinescoreSummary($data["away"]);
		$this->home = new LinescoreSummary($data["home"]);
	}

	public function getAway(): LinescoreSummary
	{
		return $this->away;
	}

	public function getHome(): LinescoreSummary
	{
		return $this->home;
	}
}