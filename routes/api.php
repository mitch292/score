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


Route::group(['as' => 'mlb', 'prefix' => 'mlb', 'namespace' => 'Mlb'], function() {


    Route::group(['as' => 'schedule', 'prefix' => 'schedule'], function() {

        Route::get('/today', ['as' => 'today', 'uses' => 'ScheduleController@fetchTodaysGames']);

        Route::get('/{date}', ['as' => 'schedule', 'uses' => 'ScheduleController@fetchGamesForDate']);
            // ->where(['date' => ]);
    
    });

});