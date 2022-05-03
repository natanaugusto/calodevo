<?php

namespace App\Weather\Contracts;

interface QueryInterface
{

    const CITY_NAME_ARGUMENT = 'city_name';

    public function setArgument(string $name, mixed $value): self;

    public function setCityName(string $value): self;
}
