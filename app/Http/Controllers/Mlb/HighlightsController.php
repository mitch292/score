<?php

namespace App\Http\Controllers\Mlb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\MlbService;
use App\Models\Highlight;
use App\Models\Game;
use App\Models\UserHighlight;

class HighlightsController extends Controller
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
	 * Fetch highlights for a given gamePK
	 * 
	 * @param string $gamePk - The MLB API's primary key for a given game
	 * 
	 * @return Array - An array of Highlights
	 */	
    public function fetchHighlights($gamePk)
    {
		return $this->mlbService->getHighlightsForGame($gamePk);
		
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
	 * @return void
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