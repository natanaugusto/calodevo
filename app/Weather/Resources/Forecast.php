<?php

namespace App\Weather\Resources;

use Illuminate\Http\Client\Response;

class Forecast
{
    protected Response $response;
    protected object $resource;

    public function __construct(Response $response)
    {
        $this->response = $response;
        $this->resource = $this->response->object();
    }

    public function toArray(): array
    {
        return (array) $this->resource;
    }
}
