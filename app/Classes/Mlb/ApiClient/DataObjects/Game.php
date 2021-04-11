<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class Game extends BaseDataObject
{
	private int $gamePk;
	private string $link;
	private string $gameType;
	private string $season;
	private string $gameDate;
	private string $officialDate;
	private GameStatus $status;
	private GameTeams $teams;
	private GenericLink $venue;
	private GameContent $content;
	private int $gameNumber;
	private bool $publicFacing;
	private string $doubleHeader;
	private string $tiebreaker;
	private string $calendarEventId;
	private string $seasonDisplay;
	private string $dayNight;
	private int $scheduledInnings;
	private bool $reverseHomeAwayStatus;
	private int $inningBreakLength;
	private int $gamesInSeries;
	private int $seriesGameNumber;
	private string $seriesDescription;
	private string $recordSource;
	private string $ifNecessary;
	private string $ifNecessaryDescription;

	public function __construct(array $data) {
		$this->gamePk = $data["gamePk"];
		$this->link = $data["link"];
		$this->gameType = $data["gameType"];
		$this->season = $data["season"];
		$this->gameDate = $data["gameDate"];
		$this->officialDate = $data["officialDate"];
		$this->status = new GameStatus($data["status"]);
		$this->teams = new GameTeams($data["teams"]);
		$this->venue = new GenericLink($data["venue"]);
		$this->content = new GameContent($data["content"]);
		$this->gameNumber = $data["gameNumber"];
		$this->publicFacing = $data["publicFacing"];
		$this->doubleHeader = $data["doubleHeader"];
		$this->tiebreaker = $data["tiebreaker"];
		$this->calendarEventId = $data["calendarEventID"];
		$this->seasonDisplay = $data["seasonDisplay"];
		$this->dayNight = $data["dayNight"];
		$this->scheduledInnings = $data["scheduledInnings"];
		$this->reverseHomeAwayStatus = $data["reverseHomeAwayStatus"];
		$this->inningBreakLength = $data["inningBreakLength"];
		$this->gamesInSeries = $data["gamesInSeries"];
		$this->seriesGameNumber = $data["seriesGameNumber"];
		$this->seriesDescription = $data["seriesDescription"];
		$this->recordSource = $data["recordSource"];
		$this->ifNecessary = $data["ifNecessary"];
		$this->ifNecessaryDescription = $data["ifNecessaryDescription"];
	}

	public function getGamePk(): int
	{
		return $this->gamePk;
	}

	public function getLink(): string
	{
		return $this->link;
	}

	public function getGameType(): string
	{
		return $this->gameType;
	}
	
	public function getSeason(): string
	{
		return $this->season;
	}

	public function getGameDate(): string
	{
		return $this->gameDate;
	}

	public function getOfficialDate(): string
	{
		return $this->officialDate;
	}

	public function getStatus(): GameStatus
	{
		return $this->status;
	}

	public function getTeams(): GameTeams
	{
		return $this->teams;
	}

	public function getVenue(): GenericLink
	{
		return $this->venue;
	}

	public function getContent(): GameContent
	{
		return $this->content;
	}

	public function getGameNumber(): int
	{
		return $this->gameNumber;
	}

	public function getPublicFacing(): bool
	{
		return $this->publicFacing;
	}

	public function getDoubleHeader(): string
	{
		return $this->doubleHeader;
	}

	public function getTiebreaker(): string
	{
		return $this->tiebreaker;
	}

	public function getCalendarEventId(): string
	{
		return $this->calendarEventId;
	}

	public function getSeasonDisplay(): string
	{
		return $this->seasonDisplay;
	}

	public function getDayNight(): string
	{
		return $this->dayNight;
	}

	public function getScheduledInnings(): int
	{
		return $this->scheduledInnings;
	}

	public function getReverseHomeAwayStatus(): bool
	{
		return $this->reverseHomeAwayStatus;
	}

	public function getInningBreakLength(): int
	{
		return $this->inningBreakLength;
	}

	public function getGamesInSeries(): int
	{
		return $this->gamesInSeries;
	}
	
	public function getSeriesGameNumber(): int
	{
		return $this->seriesGameNumber;
	}
	
	public function getSeriesDescription(): string
	{
		return $this->seriesDescription;
	}
	
	public function getRecordSource(): string
	{
		return $this->recordSource;
	}

	public function getIfNecessary(): string
	{
		return $this->ifNecessary;
	}

	public function getIfNecessaryDescription(): string
	{
		return $this->ifNecessaryDescription;
	}
}