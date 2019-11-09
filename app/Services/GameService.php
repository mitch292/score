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


	/**
	 * Fetch score's formatted games from an array of MLB Game Ids
	 * 
	 * @param Array $gameIds - an array of gameIds that are representative of MLB's gamePk
	 * 
	 * @return Array - score's univerisal game format used on the front end
	 */
	public function fetchGamesDataFromIds($gameIds)
	{
		return $this->sanitizeGames($this->formatEmptyGamesFromGameIds($gameIds));
	}


	/**
	 * Sanitize a set of raw games to be in score's format
	 * 
	 * @param Array $rawGames - an array of rawGames that is in Mlb's data format
	 * 
	 * @return Array - score's univerisal game format used on the front end
	 */
	public function sanitizeGames($rawGames)
	{
		return $this->appendQuickAccessTeamData($this->appendGameData($rawGames));
	}


	/**
	 * Fetch raw MLB game data 
	 * 
	 * @param String $gameId - the MLB game id
	 * 
	 * @return Object - A raw mlb data structure with all keys that score's format expects
	 */	
	public function fetchGameData($gameId)
	{
		$gameData = $this->mlbGameApi->fetchGameData($gameId);
		return $this->formatGame(json_decode($gameData));

	}


	/**
	 * Add some easy to access team data to the game's data structure
	 * 
	 * @param Array $games - an array of raw mlb game objects to append to
	 * 
	 * @return Array - An array of game objects with the game's team data appended
	 */	
	private function appendQuickAccessTeamData($games)
    {
        foreach ($games as $game) {
            $game->teams->away->quickAccess = Team::where('external_id', $game->gameData['teams']->away->id)->first();
            $game->teams->home->quickAccess = Team::where('external_id', $game->gameData['teams']->home->id)->first();
		}
        return $games;
	}


	/**
	 * Append required gameData to the game
	 * 
	 * @param Array $games - an array of raw mlb game objects to append to
	 * 
	 * @return Array - An array of game objects with the game's team data appended
	 */	
	private function appendGameData($games)
    {
        foreach ($games as $game) {
            $game->gameData = $this->fetchGameData($game->gamePk);
        }
        return $games;
    }


	/**
	 * Format a game in score's data structure
	 * 
	 * @param Object $game - A game objecrt
	 * 
	 * @return AssociativeArray - A game in score's format
	 */	
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


	/**
	 * Format some empty game data structures from game ids
	 * 
	 * @param Array $gameIds - A set of game ids
	 * 
	 * @return Array - An array of empty games for the game ids
	 */	
	private function formatEmptyGamesFromGameIds($gameIds)
	{
		$games = [];

		foreach ($gameIds as $gameId) {
			array_push($games, $this->formatEmptyGameFromGameId($gameId));
		}

		return $games;
	}


	/**
	 * Format an empty game from a game id
	 * 
	 * @param String $gameId - An MLB game id
	 * 
	 * @return Object - An empty game object
	 */	
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
