<?php
uses(classAndTraits: \Tests\TestCase::class);
use App\Services\Weather\Client;

test(description: 'Instanciate a Weather Client Object', closure: function () {
    $baseUrl = config(key: 'weather.openweathermap.base_api')
        . config(key: 'weather.openweathermap.version')
        . '/weather';
    $weather = new Client(
        baseUrl: $baseUrl,
        apiKey: config(key: 'weather.openweathermap.api_key')
    );
    $return = $weather->getByQuery(q: 'Franco da Rocha');
    $this->assertInstanceOf(
        expected: \App\Services\Weather\Forecast::class,
        actual: $return
    );
});
