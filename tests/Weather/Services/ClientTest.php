<?php

use App\Weather\Services\Client;
use App\Weather\Contracts\ForecastInterface;

$forecast = new class implements ForecastInterface {
    private string $cityName = 'Franco da Rocha';
    public array $response;

    public function parse(\Illuminate\Http\Client\Response $response): ForecastInterface
    {
        $this->response = json_decode(json: $response->body(), associative: true);
        return $this;
    }

    public function toWeatherQuery(): \App\Weather\Contracts\QueryInterface
    {
        return (new \App\Weather\Services\Query())->setCityName(value: $this->cityName);
    }
};


test(description: 'Instanciate a Weather Client Object', closure: function () use ($forecast) {
    mockHttp();

    $weather = new Client(new \App\Weather\Drivers\OpenWeatherMapDriver(), forecast: $forecast);
    $return = $weather->getByQuery();
    $this->assertInstanceOf(
        expected: ForecastInterface::class,
        actual: $return
    );
});
