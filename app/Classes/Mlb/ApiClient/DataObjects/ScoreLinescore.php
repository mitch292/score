<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class ScoreLinescore extends BaseDataObject
{
	private ?int $currentInning;
	private ?string $currentInningOrdinal;
	private ?string $inningState;
	private ?string $inningHalf;
	private ?bool $isTopInning;
	private int $scheduledInnings;
	/** @var LinescoreInning[] */
	private array $innings;
	private LinescoreTeams $teams;

	public function __construct(array $data) {
		$this->currentInning = $data["currentInning"] ?? null;
		$this->currentInningOrdinal = $data["currentInningOrdinal"] ?? null;
		$this->inningState = $data["inningState"] ?? null;
		$this->inningHalf = $data["inningHalf"] ?? null;
		$this->isTopInning = $data["isTopInning"] ?? null;
		$this->scheduledInnings = $data["scheduledInnings"];
		$this->innings = array_map(fn ($inning) => new LinescoreInning($inning), $data["innings"]);
		$this->teams = new LinescoreTeams($data["teams"]);
	}

	public function getCurrentInning(): ?int
	{
		return $this->currentInning;
	}

	public function getCurrentInningOrdinal(): ?string
	{
		return $this->currentInningOrdinal;
	}

	public function getInningState(): ?string
	{
		return $this->inningState;
	}

	public function getInningHalf(): ?string
	{
		return $this->inningHalf;
	}

	public function getIsTopInning(): ?bool
	{
		return $this->isTopInning;
	}

	public function getScheduluedInnings(): int
	{
		return $this->scheduledInnings;
	}

	/** @return LinescoreInning[] */
	public function getInnings(): array
	{
		return $this->innings;
	}

	public function getTeams(): LinescoreTeams
	{
		return $this->teams;
	}
}