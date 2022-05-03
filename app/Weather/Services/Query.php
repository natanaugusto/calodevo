<?php

namespace App\Weather\Services;

use App\Weather\Contracts\QueryInterface;

class Query implements QueryInterface, \Illuminate\Contracts\Support\Arrayable
{
    protected array $args;

    public function setArgument(string $name, mixed $value): QueryInterface
    {
        $this->args[$name] = $value;
        return $this;
    }

    public function setCityName(string $value): QueryInterface
    {
        $this->args[QueryInterface::CITY_NAME_ARGUMENT] = $value;
        return $this;
    }

    public function toArray(): array
    {
        return $this->args;
    }
}
