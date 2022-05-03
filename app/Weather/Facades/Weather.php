<?php

namespace App\Weather\Facades;

use App\Weather\Contracts\QueryInterface;
use App\Weather\Services\Client;

/**
 * @method static getByQuery(QueryInterface $q = null)
 * @see Client::getByQuery()
 */
class Weather extends \Illuminate\Support\Facades\Facade
{
    const BINDING_NAME = 'weather';

    protected static function getFacadeAccessor(): string
    {
        return self::BINDING_NAME;
    }
}
