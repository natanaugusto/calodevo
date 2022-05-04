<?php
use App\Models\City;
uses(classAndTraits: \Illuminate\Foundation\Testing\RefreshDatabase::class);

test(description: 'Instanciate a City Model Object and CRUD one register', closure: function () {
    $city = City::factory()->create();
    $this->assertInstanceOf(expected: City::class, actual: $city);
    $this->assertDatabaseHas(table: City::class, data: $city->toArray());

    $city->name = 'Franco da Rocha';
    $city->save();
    $this->assertDatabaseHas(table: City::class, data: ['name' => $city->name]);

    $city->delete();
    $this->assertSoftDeleted(table: City::class, data: ['id' => $city->id]);
});
