<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property Forecast $forecasts
 * @see City::forecasts()
 * @property Forecast $lastForecast
 * @see City::lastForecast()
 */
class City extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'name' => 'string',
        'country' => 'string',
        'lat' => 'float:8,6',
        'long' => 'float:9,6',
    ];

    public function forecasts(): HasMany
    {
        return $this->hasMany(related: Forecast::class);
    }

    public function lastForecast(): HasOne
    {
        return $this->hasOne(related: Forecast::class)->latestOfMany();
    }
}
