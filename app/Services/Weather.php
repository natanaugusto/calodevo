<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class Weather
{
    /**
     * Base URL to the Weather API
     * @var string
     */
    private string $baseUrl = 'https://api.openweathermap.org/data/2.5/weather';
    /**
     * The API KEY for the Weather API
     * @var string
     */
    private string $apiKey = 'b33d4b4fd8923cf5cd98cf6a5bfdefc2';
    /**
     * Units of measurement
     * @var string
     */
    private string $units = 'metric';

    /**
     * Return the weather from the passed query
     * @param string $q
     * @return Response
     */
    public function getByQuery(string $q): Response
    {
        return Http::get($this->baseUrl, [
            'q' => $q,
            'appid' => $this->apiKey,
            'units' => $this->units,
        ]);
    }
}
