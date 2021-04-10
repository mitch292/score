<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class TeamRecord extends BaseDataObject
{
	private int $wins;
	private int $losses;
	private string $pct;

	public function __construct(array $data) {
		$this->wins = $data["wins"];
		$this->losses = $data["losses"];
		$this->pct = $data["pct"];
	}

	public function getWins(): int
	{
		return $this->wins;
	}

	public function getLosses(): int
	{
		return $this->losses;
	}

	public function getPct(): string
	{
		return $this->pct;
	}
}