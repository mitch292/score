<?php

namespace App\Http\Controllers\Mlb;

use Illuminate\Http\Request;
use Carbon\Carbon;

class PlayerController extends BaseController
{
    // playerId maps to the id assigned by mlb
    public function fetchPlayerDetails($playerId)
    {
        return $this->fetchPlayerDetails($playerId);
    }

}
