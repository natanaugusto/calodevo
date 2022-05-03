<?php

namespace App\Weather\Drivers;

use App\Weather\Contracts\DriverInterface;
use App\Weather\Contracts\QueryInterface;
use Illuminate\Support\Facades\Http;

class OpenWeatherMapDriver implements DriverInterface
{
    public function getBaseUrl(): string
    {
        return config(key: 'weather.openweathermap.base_api')
        . config(key: 'weather.openweathermap.version')
        . '/weather';
    }

    public function getApiKey(): string
    {
        return config(key: 'weather.openweathermap.api_key');
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
}
