<?php

namespace App\Http\Controllers\Mlb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use App\Services\MlbService;

class ScheduleController extends Controller
{

    /**
     * @var MlbService
     */
    private $mlbService;

    public function __construct()
    {
        $this->mlbService = app(MlbService::class);
    }


	/**
	 * Fetch the games for today from the MLB API
	 * 
	 * @return Array
	 */	
    public function getScheduledGamesForToday(): Collection
    {
        return $this->getGamesForDate(Carbon::today('America/New_York'));
    }


	/**
	 * Fetch the games for a given date from the MLB API
	 * 
	 * @param string $date - in a carbon parsable format
	 * 
	 * @return Array
	 */	
    public function getGamesForDate(string $date): Collection
    {
        $date = Carbon::parse($date);

        return $this->mlbService->getGamesForDate($date);
    }

}
