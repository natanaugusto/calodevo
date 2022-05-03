<?php

use App\Weather\Services\Client;

test(description: 'Instanciate a Weather Client Object', closure: function () {
    mockHttp();

    $weather = new Client(new \App\Weather\Drivers\OpenWeatherMapDriver(), forecast: new App\Models\Forecast());
    $return = $weather->getByQuery(q: 'Franco da Rocha');
    $this->assertInstanceOf(
        expected: \App\Models\Forecast::class,
        actual: $return
    );
});
