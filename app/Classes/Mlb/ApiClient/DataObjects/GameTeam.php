<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class GameTeam extends BaseDataObject
{
	private TeamRecord $leagueRecord;
	private int $score;
	private TeamLink $team;
	private bool $splitSquad;
	private int $seriesNumber;

	public function __construct(array $data) {
		$this->leagueRecord = new TeamRecord($data["leagueRecord"]);
		$this->score = $data["score"] ?? 0;
		$this->team = new TeamLink($data["team"]);
		$this->splitSquad = $data["splitSquad"];
		$this->seriesNumber = $data["seriesNumber"];
	}

	public function getLeagueRecord(): TeamRecord
	{
		return $this->leagueRecord;
	}

	public function getScore(): int
	{
		return $this->score;
	}

	public function getTeam(): TeamLink
	{
		return $this->team;
	}

	public function getSplitSquad(): bool
	{
		return $this->splitSquad;
	}

	public function getSeriesNumber(): int
	{
		return $this->seriesNumber;
	}
}