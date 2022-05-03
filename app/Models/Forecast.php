<?php

namespace App\Models;

use App\Weather\Contracts\ForecastInterface;
use Illuminate\Database\Eloquent\Model;

class Forecast extends Model implements ForecastInterface
{
    protected object $response;

    public function parse(\Illuminate\Http\Client\Response $response): ForecastInterface
    {
        $this->response = (object)json_decode(json: $response->body(), associative: true);
        return $this;
    }

    public function toWeatherQuery(): \App\Weather\Contracts\QueryInterface
    {
        return (new \App\Weather\Services\Query())->setCityName(value: $this->city()->name);
    }

    public function city(): object
    {
        return new class {
            public string $name = 'Franco da Rocha';
        };
    }
}
