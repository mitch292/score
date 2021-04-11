<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\MlbService;
use App\Classes\Mlb\ApiClient\Client;

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
            $client = new Client(config('services.mlb.api_base_url'), config('services.mlb.game_api_base_url'));
            return new MlbService($client);
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
