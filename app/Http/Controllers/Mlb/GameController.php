<?php

namespace App\Http\Controllers\Mlb;

use Illuminate\Http\Request;

class GameController extends BaseController
{
    public function fetchGameData($gameId)
    {
      return $this->mlbApi->fetchGameData($gameId);
    }
}
