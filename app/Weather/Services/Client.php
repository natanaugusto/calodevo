<?php

namespace App\Weather\Services;

use App\Weather\Contracts\DriverInterface;
use App\Weather\Contracts\ForecastInterface;
use App\Weather\Contracts\QueryInterface;

class Client
{
    private ForecastInterface $forecast;
    private DriverInterface $driver;

    public function __construct(DriverInterface $driver, ForecastInterface $forecast)
    {
        $this->driver = $driver;
        $this->forecast = $forecast;
    }

    public function getByQuery(QueryInterface $q = null): ForecastInterface
    {
        return $this->forecast->parse(
            $this->driver->getFromAPI(q: empty($q) ?$this->forecast->toWeatherQuery() : $q)
        );
    }
}
