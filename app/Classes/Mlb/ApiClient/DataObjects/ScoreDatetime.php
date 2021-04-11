<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class ScoreDatetime extends BaseDataObject
{
	private string $dateTime;
	private string $originalDate;
	private string $dayNight;
	private string $time;
	private string $ampm;

	public function __construct(array $data) {
		$this->dateTime = $data["dateTime"];
		$this->originalDate = $data["originalDate"];
		$this->dayNight = $data["dayNight"];
		$this->time = $data["time"];
		$this->ampm = $data["ampm"];
	}

	public function getDateTime(): string
	{
		return $this->dateTime;
	}

	public function getOriginalDate(): string
	{
		return $this->originalDate;
	}

	public function getDayNight(): string
	{
		return $this->dayNight;
	}
	
	public function getTime(): string
	{
		return $this->time;
	}

	public function getAmpm(): string
	{
		return $this->ampm;
	}
}