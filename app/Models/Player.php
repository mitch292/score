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


    // expects format of mlb api player response
    public static function formatPlayer($mlbPlayer)
    {
        if (!empty($mlbPlayer)) {
            return [
                'first_name' => $mlbPlayer->firstName ?? null,
                'last_name' => $mlbPlayer->lastName ?? null,
                'full_name' => $mlbPlayer->fullName ?? null,
                'birth_city' => $mlbPlayer->birthCity ?? null,
                'birth_state_province' => $mlbPlayer->birthStateProvince ?? null,
                'birth_country' => $mlbPlayer->birthCountry ?? null,
                'external_id' => $mlbPlayer->id ?? null,
            ];
        }

        return null;
    }

}
