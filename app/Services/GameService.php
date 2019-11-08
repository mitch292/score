<?php

namespace App\Services;

use App\ApiClients\MlbGameApiClient;
use App\Services\PlayerService;
use App\Models\Team;

class GameService
{

	public function __construct()
	{
        $this->mlbGameApi = new MlbGameApiClient();
        $this->player = new PlayerService();
	}


	// array of game ids
	public function fetchGamesDataFromIds($gameIds)
	{
		return $this->sanitizeGames($this->formatGamesFromGameIds($gameIds));
	}


	public function sanitizeGames($rawGames)
	{
		return $this->appendQuickAccessTeamData($this->appendGameData($rawGames));
	}


	// a single game id
	public function fetchGameData($gameId)
	{
		$gameData = $this->mlbGameApi->fetchGameData($gameId);
		return $this->formatGame(json_decode($gameData));

	}


	private function appendQuickAccessTeamData($games)
    {
        foreach ($games as $game) {
            $game->teams->away->quickAccess = Team::where('external_id', $game->gameData['teams']->away->id)->first();
            $game->teams->home->quickAccess = Team::where('external_id', $game->gameData['teams']->home->id)->first();
		}
        return $games;
	}
	

	private function appendGameData($games)
    {
        foreach ($games as $game) {
            $game->gameData = $this->fetchGameData($game->gamePk);
        }
        return $games;
    }


	private function formatGame($game)
	{
		return [
			'pitchers' => [
				'home' => !empty($game->gameData->probablePitchers->home)
					? $this->player->get($game->gameData->probablePitchers->home->id)
					: [],
				'away' => !empty($game->gameData->probablePitchers->away)
					? $this->player->get($game->gameData->probablePitchers->away->id)
					: [],
			],
			'weather' => $game->gameData->weather,
			'datetime' => $game->gameData->datetime,
			'linescore' => $game->liveData->linescore,
			'boxscore' => $game->liveData->boxscore,
			'teams' => $game->gameData->teams,
		];
	}


	private function formatGamesFromGameIds($gameIds)
	{
		$games = [];

		foreach ($gameIds as $gameId) {
			array_push($games, $this->formatEmptyGameFromGameId($gameId));
		}

		return $games;
	}

	
	private function formatEmptyGameFromGameId($gameId)
	{
		$game = new \stdClass;
		$game->teams = new \stdClass;
		$game->teams->away = new \stdClass;
		$game->teams->home = new \stdClass;
		$game->gamePk = $gameId;

		return $game;
	}

}
