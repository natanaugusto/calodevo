<?php
use App\Weather\Resources\Forecast;
use Illuminate\Support\Facades\Http;

test(description: 'Instanciate a Weather Forecast Object', closure: function () {
    mockHttp();
    $baseUrl = config(key: 'weather.openweathermap.base_api')
        . config(key: 'weather.openweathermap.version')
        . '/weather';

    $http = Http::get($baseUrl);
    $forecast = new Forecast(response: $http);
    $this->assertInstanceOf(
        expected: Forecast::class,
        actual: $forecast
    );

    $this->assertIsArray(actual: $forecast->toArray());
});
