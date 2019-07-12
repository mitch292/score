<?php

namespace App\Http\Controllers\Mlb;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Team;

class ScheduleController extends BaseController
{
    public function fetchTodaysGames()
    {
        return $this->fetchGamesForDate(Carbon::today());
    }

    public function fetchGamesForDate($date)
    {
        $date = Carbon::parse($date)->format('m/d/Y');

        $games = $this->mlbApi->fetchGamesForDate($date);

        return $this->appendQuickAccessGameData($games);
    }

    private function appendQuickAccessGameData($games)
    {
        foreach ($games as $game) {
            $game->teams->away->quickAccess = Team::where('external_id', $game->teams->away->team->id)->first();
            $game->teams->home->quickAccess = Team::where('external_id', $game->teams->home->team->id)->first();
        }
        return $games;
    }
}
