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

    
    
Route::group(['as' => 'mlb.', 'prefix' => 'mlb', 'namespace' => 'Mlb'], function() {


    Route::group(['as' => 'schedule.', 'prefix' => 'schedule'], function() {

        Route::get('/today', ['as' => 'today', 'uses' => 'ScheduleController@fetchTodaysGames']);

        Route::get('/{date}', ['as' => 'date', 'uses' => 'ScheduleController@fetchGamesForDate']);

    });

    Route::group(['as' => 'game.', 'prefix' => 'game'], function() {

        Route::delete('/', ['as' => 'deleteGame', 'uses' => 'GameController@deleteGame']);

        Route::post('/save', ['as' => 'save', 'uses' => 'GameController@saveGame']);

        Route::get('/my-games', ['as' => 'myGames', 'uses' => 'GameController@fetchMyGames']);
    });

    Route::group(['as' => 'highlights.', 'prefix' => 'highlights'], function() {
        
        Route::get('/my-highlights', ['as' => 'fetchMyHighlights', 'uses' => 'HighlightsController@fetchMyHighlights']);

        Route::get('/{gamePk}', ['as' => 'fetchHighlights', 'uses' => 'HighlightsController@fetchHighlights']);

        Route::delete('/', ['as' => 'deleteHighlight', 'uses' => 'HighlightsController@deleteHighlight']);

        Route::post('/', ['as' => 'saveHighlight', 'uses' => 'HighlightsController@saveHighlight']);


    });

});


// Auth routes
Route::group(['as' => 'api.', 'prefix' => 'api'], function() {
    Route::group(['as' => 'auth.', 'prefix' => 'auth', 'namespace' => 'Auth'], function() {
        
        Route::post('/register', ['as' => 'register', 'uses' => 'RegisterController@newUser']);
        
        Route::get('/login/{provider}', ['as' => 'login.oauth', 'uses' => 'LoginController@redirectToProvider']);
        
        Route::get('/login/{provider}/callback', ['as' => 'login.oauth.callback', 'uses' => 'LoginController@handleProviderCallback']);
        
        Route::post('/login', ['as' => 'login', 'uses' => 'LoginController@login']);
        
        Route::post('/logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);
        
    });
});
