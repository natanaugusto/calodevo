<?php

namespace App\Weather\Contracts;

use App\Weather\Services\Forecast;

interface DriverInterface
{
    public function getByQuery(mixed $q): Forecast;
}
