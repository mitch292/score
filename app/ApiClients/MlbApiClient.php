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

    // TODO: add error handling where player id is invalid
    public function fetchPlayerDetails($playerId)
    {
        $response = $this->client->get('people'.$playerId);

        return json_decode($response->getBody()->getContents());
    }

}
