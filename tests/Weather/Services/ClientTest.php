<?php
use App\Weather\Services\Client;

test(description: 'Instanciate a Weather Client Object', closure: function () {
    mockHttp();
    $baseUrl = config(key: 'weather.openweathermap.base_api')
        . config(key: 'weather.openweathermap.version')
        . '/weather';
    $weather = new Client(new \App\Weather\Drivers\OpenWeatherMapDriver(
        baseUrl: $baseUrl,
        apiKey: config(key: 'weather.openweathermap.api_key')
    ));
    $return = $weather->getByQuery(q: 'Franco da Rocha');
    $this->assertInstanceOf(
        expected: \App\Weather\Resources\Forecast::class,
        actual: $return
    );
});
