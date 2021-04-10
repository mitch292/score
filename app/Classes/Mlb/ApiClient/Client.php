<?php

namespace App\Classes\Mlb\ApiClient;

use GuzzleHttp\Client as GuzzleClient;

class Client
{
	public function __construct(
		protected string $baseUri, 
		protected string $gameUri
	) {}

	/** @return People */
	public function people(): People
	{
		if (is_null($this->people)) {
			$this->people = new People(GuzzleClient(['base_uri' => $this->baseUri]));
		}

		return $this->people;
	}
}