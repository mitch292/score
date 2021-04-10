<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class Date extends BaseDataObject
{
	private string $date;
	private int $totalItems;
	private int $totalEvents;
	private int $totalGames;
	private int $totalGamesInProgress;
	/** @var Game[] */
	private array $games;

	public function __construct(array $data) {
		$this->date = $data["date"];
		$this->totalItems = $data["totalItems"];
		$this->totalEvents = $data["totalEvents"];
		$this->totalGames = $data["totalGames"];
		$this->totalGamesInProgress = $data["totalGamesInProgress"];
		$this->games = array_map(fn($game) => new game($date), $data["games"]);
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

	/** @return Game[] */
	public function getGames(): array
	{
		return $this->game;
	}
}