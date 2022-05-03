<?php

namespace App\Weather\Providers;

use Illuminate\Support\ServiceProvider;

class WeatherServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(abstract: \App\Weather\Contracts\ForecastInterface::class, concrete: function () {
            return new \App\Models\Forecast();
        });

        $this->app->singleton(abstract: \App\Weather\Contracts\DriverInterface::class, concrete: function () {
            return new \App\Weather\Drivers\OpenWeatherMapDriver();
        });

        $this->app->singleton(abstract: \App\Weather\Facades\Weather::BINDING_NAME, concrete: function ($app) {
            return $app->make(\App\Weather\Services\Client::class);
        });
    }

    public function boot(): void
    {

    }
}
