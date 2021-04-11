<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class ScoreTeam extends BaseDataObject
{
	private int $id;
	private string $name;
	private string $link;
	private int $season;
	private GenericLink $venue;
	private GameSpringVenue $springVenue;
	private string $teamCode;
	private string $fileCode;
	private string $abbreviation;
	private string $teamName;
	private string $locationName;
	private string $firstYearOfPlay;
	private GenericLink $league;
	private GenericLink $division;
	private GenericLink $sport;
	private string $shortName;
	private ScoreRecord $record;
	private GenericLink $springLeague;
	private string $allStarStatus;
	private bool $active;


	public function __construct(array $data) {
		$this->id = $data["id"];
		$this->name = $data["name"];
		$this->link = $data["link"];
		$this->season = $data["season"];
		$this->venue = new GenericLink($data["venue"]);
		$this->springVenue = new GameSpringVenue($data["springVenue"]);
		$this->teamCode = $data["teamCode"];
		$this->fileCode = $data["fileCode"];
		$this->abbreviation = $data["abbreviation"];
		$this->teamName = $data["teamName"];
		$this->locationName = $data["locationName"];
		$this->firstYearOfPlay = $data["firstYearOfPlay"];
		$this->league = new GenericLink($data["league"]);
		$this->division = new GenericLink($data["division"]);
		$this->sport = new GenericLink($data["sport"]);
		$this->shortName = $data["shortName"];
		$this->record = new ScoreRecord($data["record"]);
		$this->springLeague = new GenericLink ($data["springLeague"]);
		$this->allStarStatus = $data["allStarStatus"];
		$this->active = $data["active"];
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getLink(): string
	{
		return $this->link;
	}

	public function getSeason(): int
	{
		return $this->season;
	}

	public function getVenue(): GenericLink
	{
		return $this->venue;
	}
	
	public function getSpringVenue(): GameSpringVenue
	{
		return $this->springVenue;
	}

	public function getTeamCode(): string
	{
		return $this->teamCode;
	}

	public function getFileCode(): string
	{
		return $this->fileCode;
	}

	public function getAbbreviation(): string
	{
		return $this->abbreviation;
	}

	public function getTeamName(): string
	{
		return $this->teamName;
	}

	public function getLocationName(): string
	{
		return $this->locationName;
	}

	public function getFirstYearOfPlay(): string
	{
		return $this->firstYearOfPlay;
	}

	public function getLeague(): GenericLink
	{
		return $this->league;
	}

	public function getDivision(): GenericLink
	{
		return $this->division;
	}


	public function getSport(): GenericLink
	{
		return $this->sport;
	}

	public function getShortName(): string
	{
		return $this->shortName;
	}

	public function getRecord(): ScoreRecord
	{
		return $this->record;
	}
	
	public function getSpringLeague(): GenericLink
	{
		return $this->springLeague;
	}
	
	public function getSllStarStatus(): string
	{
		return $this->allStarStatus;
	}

	public function getActive(): bool
	{
		return $this->active;
	}
}