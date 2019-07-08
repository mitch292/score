<?php

namespace App\Http\Controllers\Mlb;

use Illuminate\Http\Request;
use Carbon\Carbon;

class ScheduleController extends BaseController
{
    public function fetchTodaysGames()
    {
        return $this->fetchGamesForDate(Carbon::today());
    }

    public function fetchGamesForDate($date)
    {
        $date = Carbon::parse($date)->format('m/d/Y');
        return $this->mlbApi->fetchGamesForDate($date);
    }
}
