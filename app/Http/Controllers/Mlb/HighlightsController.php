<?php

namespace App\Http\Controllers\Mlb;

use Illuminate\Http\Request;
use App\Models\Highlight;
use App\Models\Game;

class HighlightsController extends BaseController
{

    public function fetchHighlights($gamePk)
    {
		$highlights = $this->mlbApi->fetchHighlights($gamePk);
		return $this->sanitizeHighlights($highlights, $gamePk);
		// return $highlights;
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

}