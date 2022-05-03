<?php

namespace App\Weather\Services;

use App\Weather\Contracts\DriverInterface;
use Illuminate\Database\Eloquent\Model;

class Client
{
    private Model $forecast;
    private DriverInterface $driver;

    public function __construct(DriverInterface $driver, Model $forecast)
    {
        $this->driver = $driver;
        $this->forecast = $forecast;
    }


    public function getByQuery(mixed $q): Model {
        $this->driver->getFromAPI(q: $q);
        return $this->forecast;
    }
}
