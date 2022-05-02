<?php

namespace App\Weather\Contracts;

use App\Weather\Resources\Forecast;

interface DriverInterface
{
    /**
     * The base URL for request
     * @return string
     */
    function getBaseUrl(): string;

    /**
     * The API Key for request
     * @return string
     */
    function getApiKey(): string;

    /**
     * Get a weather forecast by the query passed
     * @param mixed $q
     * @return Forecast
     */
    function getByQuery(mixed $q): Forecast;

    /**
     * Mount the querystring array to Http Request
     * @param mixed $q
     * @return array
     */
    function resolveQuery(mixed $q): array;
}
