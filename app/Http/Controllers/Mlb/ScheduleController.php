<?php

namespace App\Http\Controllers\Mlb;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Team;
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
        return $this->fetchGamesForDate(Carbon::today());
    }

    public function fetchGamesForDate($date)
    {
        $date = Carbon::parse($date)->format('m/d/Y');

        $games = $this->mlbApi->fetchGamesForDate($date);
        \Debugbar::info($games);

        $games = $this->appendQuickAccessTeamData($games);

        return $this->appendGameData($games);


    }

    private function appendQuickAccessTeamData($games)
    {
        foreach ($games as $game) {
            $game->teams->away->quickAccess = Team::where('external_id', $game->teams->away->team->id)->first();
            $game->teams->home->quickAccess = Team::where('external_id', $game->teams->home->team->id)->first();
        }
        return $games;
    }

    private function appendGameData($games)
    {
        foreach ($games as $game) {
            $game->gameData = $this->game->fetchGameData($game->gamePk);
        }
        return $games;
    }
}
