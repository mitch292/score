<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class ScoreWeather extends BaseDataObject
{
	private ?string $condition;
	private ?string $temp;
	private ?string $wind;

	public function __construct(array $data) {
		$this->condition = $data["condition"] ?? null;
		$this->temp = $data["temp"] ?? null;
		$this->wind = $data["wind"] ?? null;
	}

	public function getCondition(): ?string
	{
		return $this->condition;
	}

	public function getTemp(): ?string
	{
		return $this->temp;
	}

	public function getWind(): ?string
	{
		return $this->wind;
	}
	
}