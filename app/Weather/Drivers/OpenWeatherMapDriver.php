<?php

namespace App\Weather\Drivers;


class OpenWeatherMapDriver extends BaseDriver
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
}
