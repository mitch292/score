<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('master', ['isUserAuthenticated' => Auth::check()]);
});

    
    
Route::group(['as' => 'mlb', 'prefix' => 'mlb', 'namespace' => 'Mlb'], function() {


    Route::group(['as' => 'schedule', 'prefix' => 'schedule'], function() {

        Route::get('/today', ['as' => 'today', 'uses' => 'ScheduleController@fetchTodaysGames']);

        Route::get('/{date}', ['as' => 'schedule', 'uses' => 'ScheduleController@fetchGamesForDate']);
            // ->where(['date' => ]);

    });

    Route::group(['as' => 'game', 'prefix' => 'game'], function() {

        Route::post('/save', ['as' => 'game', 'uses' => 'GameController@saveGame']);

        Route::get('/my-games', ['as' => 'myGames', 'uses' => 'GameController@fetchMyGames']);
    });

});


Route::group(['as' => 'api', 'prefix' => 'api'], function() {
    Route::group(['as' => 'auth', 'prefix' => 'auth', 'namespace' => 'Auth'], function() {
    
        Route::post('/register', ['as' => 'register', 'uses' => 'RegisterController@newUser']);
    
        Route::post('/login', ['as' => 'login', 'uses' => 'LoginController@login']);
    
        Route::post('/logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);
    
    });
});

