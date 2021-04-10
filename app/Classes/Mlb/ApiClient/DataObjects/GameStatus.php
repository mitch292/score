<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class GameStatus extends BaseDataObject
{
	private string $abstractGameStatus;
	private string $codedGameState;
	private string $detailedState;
	private string $statusCode;
	private bool $startTimeTBD;
	private string $abstractGameCode;

	public function __construct(array $data) {
		$this->abstractGameStatus = $data["abstractGameStatus"];
		$this->codedGameState = $data["codedGameState"];
		$this->detailedState = $data["detailedState"];
		$this->statusCode = $data["statusCode"];
		$this->startTimeTBD = $data["startTimeTBD"];
		$this->abstractGameCode = $data["abstractGameCode"];
	}

	public function getAbstractGameStatus(): string
	{
		return $this->abstractGameStatus;
	}

	public function getCodedGameState(): string
	{
		return $this->codedGameState;
	}

	public function getDetailedState(): string
	{
		return $this->detailedState;
	}
	
	public function getStatusCode(): string
	{
		return $this->statusCode;
	}

	public function getStartTimeTBD(): bool
	{
		return $this->startTimeTBD;
	}

	public function getAbstractGameCode(): string
	{
		return $this->abstractGameCode;
	}

}