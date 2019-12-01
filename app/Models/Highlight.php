<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Highlight extends Model
{
    protected $fillable = [
		'external_id', // repesents the mlb api key
		'playback_url',
		'title',
		'description',
		'game_id'
    ];

    protected $rules = [
		'external_id' => 'required|string',
		'playback_url' => 'required|string',
		'title' => 'sometimes|nullable|string',
		'description' => 'sometimes|nullable|string',
		'game_id' => 'required|integer',
    ];

    protected $casts = [
        'external_id' => 'string',
    ];


    // REGION - RELATIONSHIPS
    
    /**
     * The users that have this game
     */
    public function game()
    {
        return $this->belongsTo('App\Models\Game', 'game_id');
    }

    // END REGION
}
