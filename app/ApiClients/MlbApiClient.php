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

        $data = json_decode($response->getBody()->getContents());

        if (empty($data->dates)) {
            return [];
        }

        return $data->dates[0]->games;
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

    public function fetchHighlights($gamePk)
    {
        $response = $this->client->get('game/'.$gamePk.'/content');
        // TODO: Error Handling here and use case where game is live (highlights->live...)
        return json_decode($response->getBody()->getContents())->highlights->highlights->items;
    }

}
