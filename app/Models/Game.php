<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'external_id', // repesents the mlb api key
    ];

    protected $rules = [
        'external_id' => 'required|string',
    ];

    protected $casts = [
        'external_id' => 'string',
    ];


    // REGION - RELATIONSHIPS
    
    /**
     * The users that have this game
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_game', 'game_id', 'user_id');
    }

    // END REGION
}
