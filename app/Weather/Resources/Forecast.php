<?php

namespace App\Weather\Resources;

use App\Weather\Contracts\DriverInterface;
use Illuminate\Http\Client\Response;

class Forecast
{
    protected DriverInterface $driver;
    protected Response $response;
    protected object $resource;

    public function __construct(Response $response, DriverInterface $driver)
    {
        $this->driver = $driver;
        $this->response = $response;
        $this->resource = $this->response->object();
    }

    public function toArray(): array
    {
        return (array) $this->resource;
    }
}
