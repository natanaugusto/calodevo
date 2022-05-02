<?php

namespace App\Services\Weather;

class Forecast
{
    protected object $weather;

    public function __construct(object $weather)
    {
        $this->weather = $weather;
    }
}
