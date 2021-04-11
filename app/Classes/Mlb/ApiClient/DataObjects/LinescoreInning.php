<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class LinescoreInning extends BaseDataObject
{
	private int $num;
	private string $ordinalNum;
	private LinescoreSummary $home;
	private LinescoreSummary $away;

	public function __construct(array $data) {
		$this->num = $data["num"];
		$this->ordinalNum = $data["ordinalNum"];
		$this->home = new LinescoreSummary($data["home"]);
		$this->away = new LinescoreSummary($data["away"]);
	}

	public function getnum(): int
	{
		return $this->num;
	}

	public function getOrdinalNum(): string
	{
		return $this->ordinalNum;
	}

	public function getHome(): LinescoreSummary
	{
		return $this->home;
	}

	public function getAway(): LinescoreSummary
	{
		return $this->away;
	}
}