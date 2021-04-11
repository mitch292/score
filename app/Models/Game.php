<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Classes\Mlb\ApiClient\DataObjects\Game as GameDataObject;
use App\Classes\Mlb\ApiClient\DataObjects\Score as ScoreDataObject;


class Game extends Model
{
    protected $fillable = [
        'external_id', // repesents the mlb api gamePK
        'schedule_data', // represents the data returned from the schedule api for the game
        'score_data', // represents the data returned from the mlb live game/score api for this game
    ];

    protected $rules = [
        'external_id' => 'required|string',
        'schedule_data' => 'sometimes|array',
        'score_data' => 'sometimes|array',
    ];

    protected $casts = [
        'external_id' => 'string',
        'schedule_data' => 'json',
        'score_data' => 'json',
    ];

    // REGION - Accessor & Mutators

    /**
     * Set the scheduled_data attribute.
     * 
     * @param GameDataObject $value
     * @return void
     */
    public function setScheduleDataAttribute(GameDataObject $value): void
    {
        $this->attributes["schedule_data"] = json_encode($value->toArray());
    }

    /**
     * Get the scheduled_data attribute.
     * 
     * @return GameDataObject
     */
    public function getScheduleDataAttribute(): GameDataObject
    {
        return new GameDataObject($this->schedule_data);
    }

    /**
     * Set the score_data attribute.
     * 
     * @param ScoreDataObject $value
     * @return void
     */
    public function setScoreDataAttribute(ScoreDataObject $value): void
    {
        $this->attributes["score_data"] = json_encode($value->toArray());
    }

    /**
     * Get the score_data attribute.
     * 
     * @return ScoreDataObject
     */
    public function getScoreDataAttribute(): ScoreDataObject
    {
        return new ScoreDataObject($this->score_data);
    }


    // REGION - RELATIONSHIPS

    /**
     * The users that have this game
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_game', 'game_id', 'user_id');
    }

    // END REGION
}
