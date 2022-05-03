<?php

use App\Weather\Services\Client;
use App\Weather\Contracts\ForecastInterface;

$forecast = new class implements ForecastInterface {
    public array $response;

    public function convert(\Illuminate\Http\Client\Response $response): ForecastInterface
    {
        $this->response = json_decode(json: $response->body(), associative: true);
        return $this;
    }
};


test(description: 'Instanciate a Weather Client Object', closure: function () use ($forecast) {
    mockHttp();

    $weather = new Client(new \App\Weather\Drivers\OpenWeatherMapDriver(), forecast: $forecast);
    $return = $weather->getByQuery(q: 'Franco da Rocha');
    $this->assertInstanceOf(
        expected: ForecastInterface::class,
        actual: $return
    );
});
