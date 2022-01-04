<?php

namespace App\Providers;

use App\Services\WeatherService\OpenWeatherMap;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(OpenWeatherMap::class, function ($app) {
            $client = new Client();
            return new OpenWeatherMap($client);
        });

        $this->app->alias(OpenWeatherMap::class, 'weather-service');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
