<?php

namespace App\Weather\Services;

use App\Weather\Contracts\DriverInterface;
use App\Weather\Contracts\ForecastInterface;

class Client
{
    private ForecastInterface $forecast;
    private DriverInterface $driver;

    public function __construct(DriverInterface $driver, ForecastInterface $forecast)
    {
        $this->driver = $driver;
        $this->forecast = $forecast;
    }


    public function getByQuery(mixed $q): ForecastInterface
    {
        return $this->forecast->convert(
            $this->driver->getFromAPI(q: $q)
        );
    }
}
