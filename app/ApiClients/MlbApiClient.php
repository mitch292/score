<?php

namespace App\ApiClients;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Carbon\Carbon;


class MlbApiClient
{

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('services.mlb.api_base_url')
        ]);
    }

    public function fetchTodaysGames()
    {
        return $this->fetchGamesForDate(Carbon::today()->format('m/d/Y'));
    }

    public function fetchGamesForDate($date)
    {
        $response = $this->client->get('schedule', [
            'query' => [
                'sportId' => 1,
                'date' => $date

            ]
        ]);

        return $response->getBody()->getContents();
    }

    public function fetchGameData($gameId)
    {
        $requestUri = 'game/'.$gameId.'/boxscore';

        $response = $this->client->get($requestUri);

        return $response->getBody()->getContents();
    }
}
