<?php

namespace App\Http\Controllers\Mlb;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Services\GameService;

class ScheduleController extends BaseController
{


    public function __construct()
    {
        $this->game = new GameService();
        parent::__construct();

    }


    public function fetchTodaysGames()
    {
        return $this->fetchGamesForDate(Carbon::today('America/New_York'));
    }


    public function fetchGamesForDate($date)
    {
        $date = Carbon::parse($date)->format('m/d/Y');

        $rawGames = $this->mlbApi->fetchGamesForDate($date);

        return $this->game->sanitizeGames($rawGames);
    }

}
