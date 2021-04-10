<?php

namespace App\Classes\Mlb\ApiClient\Api;

use GuzzleHttp\Client as GuzzleClient;

class BaseApi
{
	public function __construct(private GuzzleClient $client) {}

	protected function client(): GuzzleClient
	{
		return $this->client;
	}
}