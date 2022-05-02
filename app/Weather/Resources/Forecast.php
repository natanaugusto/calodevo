<?php

namespace App\Weather\Resources;

use Illuminate\Http\Resources\Json\JsonResource;



class Forecast extends JsonResource
{
    public function __construct(mixed $resource)
    {
        parent::__construct($resource->object());
    }

    public function toArray(mixed $request = null): array
    {
        return (array) $this->resource;
    }
}
