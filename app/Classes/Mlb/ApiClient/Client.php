<?php

namespace App\Classes\Mlb\ApiClient;

use GuzzleHttp\Client as GuzzleClient;

class Client
{
	private ?People $people = null;
	private ?Schedule $schedule = null;


	public function __construct(
		protected string $baseUri, 
		protected string $gameUri
	) {}

	public function people(): People
	{
		if (is_null($this->people)) {
			$this->people = new People(GuzzleClient(['base_uri' => $this->baseUri]));
		}

		return $this->people;
	}

	public function schedule(): Schedule
	{
		if (is_null($this->schedule)) {
			$this->schedule = new Schedule(GuzzleClient(['base_uri' => $this->baseUri]));
		}
	}
}