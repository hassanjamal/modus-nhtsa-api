<?php

namespace Tests\Feature\Vehicle;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VehicleTest extends TestCase
{
    /**
     * Test valid route to get vehicle variants
     *
     * @return void
     */
    public function test_valid_route_to_get_vehicle_variant_for_a_manufacturer_model_and_year()
    {
        $response = $this->get('/vehicles/2015/Toyota/Yaris');

        $response->assertOk();
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

    /**
     * Test if manufacturer , model and model year is provided then API returns data in required format using a GET call
     *
     * @return void
     */
    public function test_vehicle_variants_get_api_call_for_desired_format()
    {
        $response = $this->json('GET', '/vehicles/2015/Audi/A3');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'Count',
                'Results' => [
                    '*' => [
                        'Description',
                        'VehicleId'
                    ]
                ]
            ]);
    }

}
