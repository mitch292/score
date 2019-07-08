<?php

namespace App\ApiClients;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class MlbApiClient
{

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('services.mlb.api_base_url')
        ]);
    }

    public function fetchGamesForDate($date)
    {
        $response = $this->client->get('schedule', [
            'query' => [
                'sportId' => 1,
                'date' => $date

            ]
        ]);

        return json_decode($response->getBody()->getContents())->dates[0]->games;
    }

    public function fetchGameData($gameId)
    {
        $requestUri = 'game/'.$gameId.'/boxscore';

        $response = $this->client->get($requestUri);

        return $response->getBody()->getContents();
    }
}
