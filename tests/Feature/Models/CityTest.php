<?php
use App\Models\City;
use App\Models\Forecast;

use Illuminate\Support\Arr;

uses(classAndTraits: \Illuminate\Foundation\Testing\RefreshDatabase::class);

test(description: 'Models\City basic CRUD', closure: function () {
    $city = City::factory()->create();
    $this->assertInstanceOf(expected: City::class, actual: $city);
    $this->assertDatabaseHas(table: City::class, data: $city->toArray());

    $city->name = 'Franco da Rocha';
    $city->save();
    $this->assertDatabaseHas(table: City::class, data: ['name' => $city->name]);

    $city->delete();
    $this->assertSoftDeleted(table: City::class, data: ['id' => $city->id]);
});

test(description: 'Model\City relationships', closure: function () {
   $city = City::factory()->create();
   $forecast = Forecast::factory()->make();
   $city->forecasts()->save($forecast);

   $this->assertDatabaseHas(
       table: Forecast::class,
       data: ['id' => $forecast->id, 'city_id' => $city->id]
   );

   $forecast = Forecast::factory()->create([
       'city_id' => $city
   ]);
   $this->assertEquals(
       expected: $forecast->toArray(),
       actual: Arr::except(array: $city->lastForecast->toArray(), keys: ['deleted_at'])
   );
});
