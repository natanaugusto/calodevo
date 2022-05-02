<?php

namespace App\Weather\Drivers;

use App\Weather\Resources\Forecast;
use Illuminate\Support\Facades\Http;

class OpenWeatherMapDriver implements \App\Weather\Contracts\DriverInterface
{

    /**
     * Base URL to the Client API
     * @var string
     */
    private string $baseUrl;
    /**
     * The API KEY for the Client API
     * @var string
     */
    private string $apiKey;
    /**
     * Units of measurement
     * @var string
     */
    private string $units;

    /**
     * @param string $baseUrl
     * @param string $apiKey
     * @param string $units
     */
    public function __construct(string $baseUrl, string $apiKey, string $units = 'metrics')
    {
        $this->baseUrl = $baseUrl;
        $this->apiKey = $apiKey;
        $this->units = $units;
    }

    /**
     * Get a weather forecast by the query passed
     * @param mixed $q
     * @return Forecast
     */
    public function getByQuery(mixed $q): Forecast
    {
        return new Forecast(weather: (object)json_decode(
            Http::get($this->baseUrl, [
                'q' => $q,
                'appid' => $this->apiKey,
                'units' => $this->units,
            ])->body(), associative: true)
        );
    }
}
