<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Http\Clients\MlbClient;
use App\Services\MlbService;

class MlbServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(MlbService::class, function() {
            $mlbClient = new MlbClient(['base_uri' => config('services.mlb.api_base_url')]);
            $gameClient = new MlbClient(['base_uri' => config('services.mlb.game_api_base_url')]);
            return new MlbService($mlbClient, $gameClient);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
