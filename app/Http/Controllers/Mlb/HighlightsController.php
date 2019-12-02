<?php

namespace App\Http\Controllers\Mlb;

use Illuminate\Http\Request;
use App\Models\Highlight;
use App\Models\Game;
use App\Models\UserHighlight;

class HighlightsController extends BaseController
{

	/**
	 * Fetch highlights for a given gamePK
	 * 
	 * @param String $gamePk - The MLB API's primary key for a given game
	 * 
	 * @return Array - An array of Highlights
	 */	
    public function fetchHighlights($gamePk)
    {
		$highlights = $this->mlbApi->fetchHighlights($gamePk);
		
		return $this->sanitizeHighlights($highlights, $gamePk);
	}

	/**
	 * Save a highlight for an authenticated user
	 * 
	 * @param Request 
	 * 
	 * @return void
	 */	
	public function saveHighlight(Request $request)
	{
		if (empty($request->user())) {
			abort(403, 'Only authenticated users can save highlights');
		}

		if ($this->validator($request->all())->fails()) {
			abort(400, 'Please pass all required parameters');
		}
		
		$highlight = Highlight::find($request->get('id'));

		UserHighlight::updateOrCreate(['user_id' => $request->user()->id, 'highlight_id' => $highlight->id]);

		return response()->json('ok');
	}


	/**
	 * Delete a highlight that a user previously saved
	 * 
	 * @param Request
	 * 
	 * @return void\
	 */	
	public function deleteHighlight(Request $request)
	{

		if (empty($request->user())) {
			abort(403, 'Only authenticated users can delete highlights');
		}

		if ($this->validator($request->all())->fails()) {
			abort(400, 'Please pass all required parameters');
		}

		UserHighlight::where('highlight_id', $request->get('id'))->delete();

		return response()->json('ok');
	}


	/**
	 * Fetch highlights for a given user
	 * 
	 * @param Request - The request can have an optional idOnly bool
	 * 
	 * @return Array - An array of Highlights or an array of Highlight IDs
	 */	
	public function fetchMyHighlights(Request $request)
	{
		if (empty($request->user())) {
			abort(403, 'You have to be authenticated to see your highlights');
		}

		if ($request->get('idOnly') == true) {
			return $request->user()->highlights->pluck('id');
		}

		return $request->user()->highlights;
	}

	/**
	 * Fetch highlights for a given user
	 * 
	 * @param Array $highlights - an array of raw highlights from the MLB API
	 * @param String $gamePk - The extenal_id (or MLB primary key) for the game that this highlight is associated with
	 * 
	 * @return Array - An array of Highlights
	 */	
	private function sanitizeHighlights($highlights, $gamePk)
	{
		$collectionOfHighlights = collect();
		foreach ($highlights as $highlight) {
			// maybe some error handling in here
			$collectionOfHighlights->push(Highlight::firstOrCreate(['external_id' => $highlight->mediaPlaybackId], [
				'playback_url' => $highlight->playbacks[0]->url,
				'title' => $highlight->headline,
				'description' => $highlight->description,
				'game_id' => Game::firstOrCreate(['external_id' => $gamePk])->id,
			]));

		}
		return $collectionOfHighlights;
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
            'id' => ['required'],
        ]);
    }

}