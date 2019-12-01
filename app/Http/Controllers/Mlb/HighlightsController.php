<?php

namespace App\Http\Controllers\Mlb;

use Illuminate\Http\Request;
use App\Models\Highlight;

class HighlightsController extends BaseController
{

    public function fetchHighlights($gamePk)
    {
		$highlights = $this->mlbApi->fetchHighlights($gamePk);

		return $this->sanitizeHighlights($highlights);
		\Debugbar::info('the highlights', $highlights);
        return $highlights;
	}
	
	private function sanitizeHighlights($highlights)
	{

	}

}
