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
    function convert(Response $response): self;
}
