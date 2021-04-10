<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Player extends Model
{

    protected $fillable = [
        'first_name',
        'last_name',
        'full_name',
        'birth_city',
        'birth_state_province',
        'birth_country',
        'external_id',
    ];

    protected $rules = [
        'first_name' => 'string|required',
        'last_name' => 'string|required',
        'full_name' => 'string|required',
        'birth_city' => 'string|required',
        'birth_state_province' => 'string|sometimes|nullable',
        'birth_country' => 'string|required',
        'external_id' => 'string|required',
    ];
}
