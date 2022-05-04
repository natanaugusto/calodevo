<?php

namespace App\Models;

use App\Weather\Contracts\ForecastInterface;
use App\Weather\Contracts\QueryInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Client\Response;

/**
 * @property mixed $city
 * @see Forecast::city()
 */
class Forecast extends Model implements ForecastInterface
{
    use HasFactory, SoftDeletes;

    public function parse(Response $response): ForecastInterface
    {
        return $this;
    }

    public function toWeatherQuery(): ?QueryInterface
    {
        $city = $this->city()->first();
        return $city ? (new \App\Weather\Services\Query())
            ->setCityName(value: $city->name) : null;
    }

    public function city() : BelongsTo
    {
        return $this->belongsTo(related: City::class);
    }
}
