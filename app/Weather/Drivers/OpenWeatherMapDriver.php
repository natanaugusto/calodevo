<?php

namespace App\Weather\Drivers;

use App\Weather\Contracts\DriverInterface;
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

    public function resolveQuery(mixed $q): array
    {
        return array_merge([
            'q' => $q,
            'appid' => $this->getApiKey()
        ]);
    }

    public function getFromAPI(mixed $q): \Illuminate\Http\Client\Response
    {
        return Http::get(
            url: $this->getBaseUrl(),
            query: $this->resolveQuery(q: $q)
        );
    }
}
