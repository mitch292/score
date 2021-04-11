<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class ScoreProbablePitchers extends BaseDataObject
{
	private ?ScorePitcher $away;
	private ?ScorePitcher $home;

	public function __construct(array $data) {
		$this->away = !empty($data["away"]) ? new ScorePitcher($data["away"]) : null;
		$this->home = !empty($data["home"]) ? new ScorePitcher($data["home"]) : null;
	}

	public function getAway(): ?ScorePitcher
	{
		return $this->away;
	}

	public function getHome(): ?ScorePitcher
	{
		return $this->home;
	}
}