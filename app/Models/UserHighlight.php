<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserHighlight extends Model
{
	protected $table = 'user_highlight';

    protected $fillable = [
		'user_id',
		'highlight_id',
	];

	protected $rules = [
		'user_id' => 'required|integer',
		'highlight_id' => 'required|integer',
	];
}
