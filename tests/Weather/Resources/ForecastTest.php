<?php
uses(classAndTraits: \Tests\TestCase::class);

use App\Weather\Resources\Forecast;

use Illuminate\Support\Facades\Http;

test(description: 'Instanciate a Weather Forecast Object', closure: function () {
    Http::fake(callback: function () {
        $filename =  dirname(path: __DIR__, levels: 2)
            . DIRECTORY_SEPARATOR
            . 'json'
            . DIRECTORY_SEPARATOR
            . 'weather_return.json';
        return Http::response(
            body: fopen(filename: $filename, mode: 'r'),
            status: \Symfony\Component\HttpFoundation\Response::HTTP_OK
        );
    });

    $baseUrl = config(key: 'weather.openweathermap.base_api')
        . config(key: 'weather.openweathermap.version')
        . '/weather';

    $http = Http::get($baseUrl);
    $forecast = new Forecast(resource: $http);
    $this->assertInstanceOf(
        expected: Forecast::class,
        actual: $forecast
    );

    $this->assertIsArray(actual: $forecast->toArray());
});
