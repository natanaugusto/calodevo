<?php

namespace App\Weather\Drivers;

use App\Weather\Resources\Forecast;
use Illuminate\Support\Facades\Http;

abstract class BaseDriver implements \App\Weather\Contracts\DriverInterface
{

    /**
     * Get a weather forecast by the query passed
     * @param mixed $q
     * @return Forecast
     */
    public function getByQuery(mixed $q): Forecast
    {
        return new Forecast(response: Http::get(
            url: $this->getBaseUrl(),
            query: $this->resolveQuery(q: $q)),
            driver: $this
        );
    }
}
