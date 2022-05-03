<?php

namespace App\Weather\Contracts;

use Illuminate\Http\Client\Response;

interface ForecastInterface
{
    /**
     * Convert the $response from Client Driver into a ForecastInterface
     * @param Response $response
     * @return $this
     */
    public function parse(Response $response): self;

    public function toWeatherQuery(): QueryInterface;
}
