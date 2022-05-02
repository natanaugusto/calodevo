<?php

namespace App\Weather\Resources;

class Forecast
{
    protected object $weather;

    public function __construct(object $weather)
    {
        $this->weather = $weather;
    }
}
