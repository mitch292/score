<?php

namespace App\Http\Controllers\Mlb;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Services\GameService;
use App\Services\MlbService;

class ScheduleController extends BaseController
{


    public function __construct()
    {
        $this->mlbService = app(MlbService::class);
        $this->gameService = new GameService();
        parent::__construct();

    }


	/**
	 * Fetch the games for today from the MLB API
	 * 
	 * @return Array
	 */	
    public function fetchTodaysGames()
    {
        return $this->fetchGamesForDate(Carbon::today('America/New_York'));
    }


	/**
	 * Fetch the games for a given date from the MLB API
	 * 
	 * @param String $date - in a carbon parsable format
	 * 
	 * @return Array
	 */	
    public function fetchGamesForDate($date)
    {
        $date = Carbon::parse($date)->format('m/d/Y');
        return $this->mlbService->fetchGamesForDate($date);
        // $rawGames = $this->mlbApi->fetchGamesForDate($date);
        // return $this->gameService->sanitizeGames($rawGames);
    }

}
