<?php

namespace App\Weather\Services;

use App\Weather\Contracts\DriverInterface;
use App\Weather\Resources\Forecast;

/**
 * @method getByQuery(mixed $q)
 * @see DriverInterface::getByQuery()
 */
class Client
{
    private DriverInterface $driver;

    public function __construct(DriverInterface $driver)
    {
        $this->driver = $driver;
    }

    public function __call(string $name, array $arguments): mixed
    {
        if (method_exists(object_or_class: $this->driver, method: $name)) {
            return call_user_func_array(callback: [$this->driver, $name], args: $arguments);
        }
        return null;
    }
}
