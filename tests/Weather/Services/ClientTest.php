<?php

use App\Weather\Services\Client;
use App\Weather\Facades\Weather;
use App\Weather\Contracts\QueryInterface;
use App\Weather\Contracts\DriverInterface;
use App\Weather\Contracts\ForecastInterface;
use Illuminate\Support\Facades\Http;

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

$driver = new class implements DriverInterface {
    public function getBaseUrl(): string
    {
        return 'http://weaterapi';
    }

    public function getApiKey(): string
    {
        return 'API-KEY';
    }

    public function resolveQuery(QueryInterface $q): array
    {
        $query = $q->toArray();
        return array_merge([
            'q' => $query[QueryInterface::CITY_NAME_ARGUMENT],
            'appid' => $this->getApiKey()
        ]);
    }

    public function getFromAPI(mixed $q): \Illuminate\Http\Client\Response
    {
        $query = $q instanceof QueryInterface ? $this->resolveQuery($q) : $q;
        return Http::get(
            url: $this->getBaseUrl(),
            query: $query
        );
    }
};


test(description: 'Instanciate a Weather Client Object', closure: function () use ($driver, $forecast) {
    mockHttp();

    $weather = new Client(driver: $driver, forecast: $forecast);
    $return = $weather->getByQuery();
    $this->assertInstanceOf(
        expected: ForecastInterface::class,
        actual: $return
    );
});

test(description: 'Interacting with Client and Query', closure: function () use ($driver, $forecast) {
    mockHttp();
    $weather = new Client(driver: $driver, forecast: $forecast);

    $query = new \App\Weather\Services\Query();
    $query->setCityName(value: 'Franco da Rocha');

    $return = $weather->getByQuery(q: $query);
    $this->assertInstanceOf(expected: ForecastInterface::class, actual: $return);


});

test(description: 'Using Weather facade', closure: function () {
    $this->assertInstanceOf(
        expected: ForecastInterface::class,
        actual: Weather::getByQuery()
    );
});
