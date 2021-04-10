<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class Schedule extends BaseDataObject
{
	private string $copyright;
	private int $totalItems;
	private int $totalEvents;
	private int $totalGames;
	private int $totalGamesInProgress;
	/** @var Date[] */
	private array $dates;
	private array $events;

	public function __construct(array $data) {
		$this->copyright = $data["copyright"];
		$this->totalItems = $data["totalItems"];
		$this->totalEvents = $data["totalEvents"];
		$this->totalGames = $data["totalGames"];
		$this->totalGamesInProgress = $data["totalGamesInProgress"];
		$this->dates = array_map(fn($date) => new Date($date), $data["dates"]);
		$this->events = $data["events"];
	}

	public function getCopyright(): string
	{
		return $this->copyright;
	}

	public function getTotalItems(): int
	{
		return $this->totalItems;
	}

	public function getTotalEvents(): int
	{
		return $this->totalEvents;
	}
	
	public function getTotalGames(): int
	{
		return $this->totalGames;
	}

	public function getTotalGamesInProgress(): int
	{
		return $this->totalGamesInProgress;
	}

	public function getFirstDate(): ?Date
	{
		if (empty($this->dates)) {
			return null;
		}

		return $this->dates[0];
	}

	/** @return Date[] */
	public function getDates(): array
	{
		return $this->dates;
	}

	/** Haven't seen events populated */
	public function getEvents(): array
	{
		return $this->events;
	}
}