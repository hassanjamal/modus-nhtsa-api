<?php

namespace Tests\Feature\Vehicle;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VehicleWithPayloadTest extends TestCase
{
    /**
     * Test valid route to get all vehicle
     *
     * @return void
     */
    public function test_valid_route_to_get_allvehicles()
    {
        $payLoad = [
            'modelYear' => 2015,
            'manufacturer' => 'Audi',
            'model' => 'A3'
        ];

        $response = $this->json('POST','/vehicles', $payLoad);

        $response->assertOk();
    }
}
