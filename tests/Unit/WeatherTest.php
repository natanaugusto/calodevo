<?php
use App\Services\Weather;

test('Weather get by city name', function () {
    $weather = new Weather();
    $return = $weather->getByQuery('Franco da Rocha');
    $this->assertInstanceOf(\Illuminate\Http\Client\Response::class, $return);
});
