<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGame extends Model
{
	protected $table = 'user_game';

    protected $fillable = [
		'user_id',
		'game_id',
	];

	protected $rules = [
		'user_id' => 'required|integer',
		'game_id' => 'required|integer',
	];
}
