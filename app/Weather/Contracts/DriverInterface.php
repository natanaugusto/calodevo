<?php

namespace App\Weather\Contracts;

use App\Weather\Resources\Forecast;

interface DriverInterface
{
    public function getByQuery(mixed $q): Forecast;
}
