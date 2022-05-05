<?php
use App\Models\City;
use App\Models\Forecast;

use Illuminate\Support\Arr;

uses(classAndTraits: \Illuminate\Foundation\Testing\RefreshDatabase::class);

test(description: 'Model\Forecast basic CRUD', closure: function () {
    $forecast = Forecast::factory()->create();
    $this->assertInstanceOf(expected: Forecast::class, actual: $forecast);
    $this->assertDatabaseHas(table: Forecast::class, data: $forecast->toArray());

    $forecast->delete();
    $this->assertSoftDeleted(table: Forecast::class, data: ['id' => $forecast->id]);
});

test(description: 'Model\Forecast relationships', closure: function () {
   $city = City::factory()->create();
   $forecast = Forecast::factory()->create([
       'city_id' => $city
   ]);
   $this->assertDatabaseHas(
       table: Forecast::class,
       data: ['id' => $forecast->id, 'city_id' => $city->id]
   );

   $this->assertEquals(
       expected: $city->toArray(),
       actual: Arr::except(array: $forecast->city->toArray(), keys: ['deleted_at']),
   );
});
