<?php

namespace App\Http\Controllers\Mlb;

use Illuminate\Http\Request;

class ScheduleController extends BaseController
{
    public function fetchTodaysGames()
    {
        return $this->mlbApi->fetchTodaysGames();
    }

    public function fetchGamesForDate($date)
    {
        return $this->mlbApi->fetchGamesForDate($date);
    }
}
