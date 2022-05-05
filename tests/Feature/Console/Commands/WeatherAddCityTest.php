<?php

use \App\Console\Commands\WeatherAddCity;

test(description: 'Commands\WeatherAddCity add new city', closure: function () {
    $city = \App\Models\City::factory()->create();
    $this->artisan(
        command: 'weather:add-city', parameters: ['city-name' => $city->name]
    )->expectsOutput(output: WeatherAddCity::ERROR_CITY_EXISTS)
        ->assertExitCode(exitCode: 1);
    $this->artisan(
        command: 'weather:add-city', parameters: ['city-name' => 'Franco da Rocha']
    )->assertExitCode(exitCode: 0);
});
