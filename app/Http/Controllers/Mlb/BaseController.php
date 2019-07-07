<?php

namespace App\Http\Controllers\Mlb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ApiClients\MlbApiClient;


class BaseController extends Controller
{
    public function __construct()
    {
        $this->mlbApi = new MlbApiClient();
    }
}
