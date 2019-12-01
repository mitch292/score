<?php

namespace App\Http\Controllers\Mlb;

use Illuminate\Http\Request;
use App\Models\Highlight;
use App\Models\Game;
use App\Models\UserHighlight;

class HighlightsController extends BaseController
{

    public function fetchHighlights($gamePk)
    {
		$highlights = $this->mlbApi->fetchHighlights($gamePk);
		return $this->sanitizeHighlights($highlights, $gamePk);
		// return $highlights;
	}

	public function saveHighlight(Request $request)
	{
		if (empty($request->user())) {
			abort(403, 'Only authenticated users can save highlights');
		}

		if ($this->validator($request->all())->fails()) {
			abort(400, 'Please pass all required parameters');
		}

		$highlight = Highlight::firstOrCreate(['external_id' => $request->get('external_id')]);

		UserHighlight::updateOrCreate(['user_id' => $request->user()->id, 'highlight_id' => $highlight->id]);

		return response()->json('ok');
	}

	public function fetchMyHighlights(Request $request)
	{
		if (empty($request->user())) {
			abort(403, 'You have to be authenticated to see your highlights');
		}

		return $request->user()->highlights;
	}
	
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
            'external_id' => ['required'],
        ]);
    }

}