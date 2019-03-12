<?php

namespace Tests\Feature\Vehicle;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VehicleTest extends TestCase
{
    /**
     * Test valid route to get vehicle info
     *
     * @return void
     */
    public function test_valid_route_to_get_vehicles_info_for_a_manufacturer_model_and_year()
    {
        $response = $this->get('/vehicles/2015/Toyota/Yaris');

        $response->assertStatus(200);
    }

    /**
     * Test if required manufacture , model and year of manufacture is not provided
     * API returns 404 status code
     *
     * @return void
     */
    public function test_invalid_route_should_return_404()
    {
        $urls = [
            '/vehicles/2015/Toyota',
            '/vehicles/2015',
        ];

        foreach ($urls as $url) {
            $response = $this->get($url);
            $response->assertStatus(404);

        }
    }

}
