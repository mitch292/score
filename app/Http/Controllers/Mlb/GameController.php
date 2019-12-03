<?php

namespace App\Http\Controllers\Mlb;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\UserGame;
use App\Services\GameService;

class GameController extends BaseController
{
    public function __construct()
    {
        $this->gameService = new GameService();
        parent::__construct();

    }


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
    
    public function fetchMyGames(Request $request)
    {
        if (!\Auth::check()) {
            // might need to alter this
            return response()->json([]);
        }

        if ($request->get('gamePkOnly') == true) {
			return $request->user()->games->pluck('external_id');
        }
        
        return $this->gameService->fetchGamesDataFromIds($request->user()->games->pluck('external_id'));
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
