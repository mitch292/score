<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['as' => 'mlb', 'prefix' => 'mlb'], function() {

    // TODO: Wrap this in another group for something like schedule?
    Route::get('/today', ['as' => 'todaysGames', 'uses' => 'MlbStatsController@getTodaysGames']);
});