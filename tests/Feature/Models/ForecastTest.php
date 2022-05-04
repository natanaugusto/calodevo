<?php
use App\Models\Forecast;
uses(classAndTraits: \Illuminate\Foundation\Testing\RefreshDatabase::class);

test(description: 'Instanciate a Forecast Model Object and CRUD one register', closure: function () {
    $forecast = Forecast::factory()->create();
    $this->assertInstanceOf(expected: Forecast::class, actual: $forecast);
    $this->assertDatabaseHas(table: Forecast::class, data: $forecast->toArray());

    $forecast->delete();
    $this->assertSoftDeleted(table: Forecast::class, data: ['id' => $forecast->id]);
});
