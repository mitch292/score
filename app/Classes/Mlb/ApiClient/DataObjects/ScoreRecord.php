<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class ScoreRecord extends BaseDataObject
{
	private int $gamesPlayed;
	private string $wildCardGamesBack;
	private string $leagueGamesBack;
	private string $springLeagueGamesBack;
	private string $sportGamesBack;
	private string $divisionGamesBack;
	private string $conferenceGamesBack;
	private TeamRecord $leagueRecord;
	private bool $divisionLeader;
	private int $wins;
	private int $losses;
	private string $winningPercentage;

	public function __construct(array $data) {
		$this->gamesPlayed = $data["gamesPlayed"];
		$this->wildCardGamesBack = $data["wildCardGamesBack"];
		$this->leagueGamesBack = $data["leagueGamesBack"];
		$this->springLeagueGamesBack = $data["springLeagueGamesBack"];
		$this->sportGamesBack = $data["sportGamesBack"];
		$this->divisionGamesBack = $data["divisionGamesBack"];
		$this->conferenceGamesBack = $data["conferenceGamesBack"];
		$this->leagueRecord = new TeamRecord($data["leagueRecord"]);
		$this->divisionLeader = $data["divisionLeader"];
		$this->wins = $data["wins"];
		$this->losses = $data["losses"];
		$this->winningPercentage = $data["winningPercentage"];

	}

	
	public function getGamesPlayed(): int
	{
		return $this->gamesPlayed;
	}
	
	public function getWildCardGamesBack(): string
	{
		return $this->wildCardGamesBack;
	}
	
	public function getLeagueGamesBack(): string
	{
		return $this->leagueGamesBack;
	}

	public function getSpringLeagueGamesBack(): string
	{
		return $this->springLeagueGamesBack;
	}
	
	public function getSportGamesBack(): string
	{
		return $this->sportGamesBack;
	}
	
	public function getDivisionGamesBack(): string
	{
		return $this->divisionGamesBack;
	}

	public function getConferenceGamesBack(): string
	{
		return $this->conferenceGamesBack;
	}

	public function getLeagueRecord(): TeamRecord
	{
		return $this->leagueRecord;
	}

	public function getDivisionLeader(): bool
	{
		return $this->divisionLeader;
	}

	public function getWins(): int
	{
		return $this->wins;
	}

	public function getLosses(): int
	{
		return $this->losses;
	}
	
	public function getWinningPercentage(): string
	{
		return $this->winningPercentage;
	}
}