<?php

namespace App\ApiClients;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class MlbGameApiClient
{

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('services.mlb.game_api_base_url')
        ]);
    }

    public function fetchGameData($gameId)
    {
        $requestUri = 'game/'.$gameId.'/feed/live';

        $response = $this->client->get($requestUri);

        return $response->getBody()->getContents();
    }
}
