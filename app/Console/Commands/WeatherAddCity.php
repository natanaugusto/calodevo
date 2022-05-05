<?php

namespace App\Console\Commands;

use App\Models\City;
use Illuminate\Console\Command;

class WeatherAddCity extends Command
{
    const ERROR_CITY_EXISTS = 'This city alredy exists on database';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:add-city {city-name : The city name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a city for weather historic';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $cityName = $this->argument(key: 'city-name');
        $city = City::where(column: 'name', operator: '=', value: $cityName)
            ->first();
        if ($city) {
            $this->error(string: self::ERROR_CITY_EXISTS);
            return 1;
        }
        return 0;
    }
}
