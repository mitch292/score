<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Carbon\Carbon;

class MlbStatsController extends Controller
{
    const BASE_URI = 'http://statsapi.mlb.com/api/v1/';

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => self::BASE_URI
        ]);
    }

    public function getTodaysGames()
    {
        // call a get games for date with today
        return $this->getGamesForDate(Carbon::today()->format('m/d/Y'));
    }

    public function getGamesForDate($date)
    {
        $response = $this->client->get('schedule', [
            'query' => [
                'sportId' => 1,
                'date' => $date

            ]
        ]);

        return $response->getBody()->getContents();
    }
}
