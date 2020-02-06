<?php

namespace App\Http\Controllers\Mlb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\UserGame;
use App\Services\MlbService;

class GameController extends Controller
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
	 * Save a game to a user's profile
	 * 
	 * @param Request
	 * 
	 * @return Response
	 */	
    public function saveGame(Request $request)
    {
		if (empty($request->user())) {
			abort(403, 'Only authenticated users can save games');
		}

		if ($this->validator($request->all())->fails()) {
			abort(400, 'Please pass all required parameters');
		}

		$game = Game::firstOrCreate(['external_id' => $request->get('external_id')]);

		UserGame::updateOrCreate(['user_id' => $request->user()->id, 'game_id' => $game->id]);

		return response()->json('ok');

    }


    /**
	 * Delete a game from a user's profile
	 * 
	 * @param Request
	 * 
	 * @return Response
	 */	
    public function deleteGame(Request $request)
    {
        if (empty($request->user())) {
			abort(403, 'Only authenticated users can delete highlights');
		}

		if ($this->validator($request->all())->fails()) {
			abort(400, 'Please pass all required parameters');
        }
        
        $game = Game::where('external_id', $request->get('external_id'))->firstOrFail();

		UserGame::where('game_id', $game->id)->delete();

		return response()->json('ok');
    }
    

	/**
	 * Fetch all the games for an authenticated user
	 * 
	 * @param Request
	 * 
	 * @return Array
	 */	
    public function fetchMyGames(Request $request)
    {
        if (!\Auth::check()) {
            // might need to alter this
            return response()->json([]);
        }

        if ($request->get('gamePkOnly') == true) {
			return $request->user()->games->pluck('external_id');
        }
        
		return $this->mlbService->fetchGamesFromIds($request->user()->games->pluck('external_id'));
    }


	/**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validator(array $data)
    {
        return \Validator::make($data, [
            'external_id' => ['required'],
        ]);
    }

}
