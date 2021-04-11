<?php

namespace App\Classes\Mlb\ApiClient;

use GuzzleHttp\Client as GuzzleClient;
use App\Classes\Mlb\ApiClient\Api\Score;
use App\Classes\Mlb\ApiClient\Api\People;
use App\Classes\Mlb\ApiClient\Api\Schedule;

class Client
{
	private ?People $people = null;
	private ?Schedule $schedule = null;
	private ?Score $score = null;


	public function __construct(
		protected string $baseUri, 
		protected string $gameUri
	) {}

	/**
	 * Get the people api 
	 * 
	 * @return People
	 */
	public function people(): People
	{
		if (is_null($this->people)) {
			$this->people = new People(new GuzzleClient(['base_uri' => $this->baseUri]));
		}

		return $this->people;
	}

	/**
	 * Get the schedule api
	 * 
	 * @return Schedule
	 */
	public function schedule(): Schedule
	{
		if (is_null($this->schedule)) {
			$this->schedule = new Schedule(new GuzzleClient(['base_uri' => $this->baseUri]));
		}

		return $this->schedule;
	}

	/**
	 * Get the score api
	 * 
	 * @return Score
	 */
	public function score(): Score
	{
		if (is_null($this->score)) {
			$this->score = new Score(new GuzzleClient(['base_uri' => $this->gameUri]));
		}

		return $this->score;
	}
}