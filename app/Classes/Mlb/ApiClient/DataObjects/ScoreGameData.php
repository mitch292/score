<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class ScoreGameData extends BaseDataObject
{
	private ScoreWeather $weather;
	private ScoreDatetime $datetime;
	private ScoreProbablePitchers $probablePitchers;
	private ScoreTeams $teams;

	public function __construct(array $data) {
		$this->weather = new ScoreWeather($data["weather"]);
		$this->datetime = new ScoreDatetime($data["datetime"]);
		$this->probablePitchers = new ScoreProbablePitchers($data["probablePitchers"]);
		$this->teams = new ScoreTeams($data["teams"]);
	}

	public function getWeather(): ScoreWeather
	{
		return $this->weather;
	}

	public function getDatetime(): ScoreDatetime
	{
		return $this->datetime;
	}

	public function getProbablePitchers(): ScoreProbablePitchers
	{
		return $this->probablePitchers;
	}

	public function getTeams(): ScoreTeams
	{
		return $this->teams;
	}
}