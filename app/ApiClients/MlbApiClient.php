<?php

namespace App\ApiClients;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
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

    public function fetchPlayerDetails($playerId, $default = null)
    {
        $response = $this->client->get('people/'.$playerId);

        try {
            $players = json_decode($response->getBody()->getContents());
    
            if ($players->people) {
                return $players->people[0];
            }
    
            return $default;
        } catch (RequestException $e) {
            return $default;
        }

    }

}
