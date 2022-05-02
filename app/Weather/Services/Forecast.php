<?php

namespace App\Weather\Services;

class Forecast
{
    protected object $weather;

    public function __construct(object $weather)
    {
        $this->weather = $weather;
    }
}
