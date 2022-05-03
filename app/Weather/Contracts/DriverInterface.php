<?php

namespace App\Weather\Contracts;

use Illuminate\Http\Client\Response;

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
     * Get a weather forecast from the API by the query passed
     * @param mixed $q
     * @return Response
     */
    function getFromAPI(mixed $q): Response;

    /**
     * Mount the querystring array to Http Request
     * @param mixed $q
     * @return array
     */
    function resolveQuery(mixed $q): array;
}
