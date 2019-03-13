<?php

namespace Tests\Feature\Vehicle;

use Tests\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use App\NHTSA\VehicleSafetyRatingService;

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
            '/vehicles/undefined/Toyota/Yaris',
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

    public function test_no_result_for_2013_ford_crown_victoria()
    {
        $api_response = json_encode([
            'Count' => 0,
            'Message' => "No results found for this request\"",
            'Results' =>[]
        ]);
        $this->app->bind(VehicleSafetyRatingService::class , function ($app) use ($api_response){
            $mock = new MockHandler([
                new Response(200, [], $api_response)]);

            $handler = HandlerStack::create($mock);
            $guzzleClient = new Client(['handler' => $handler]);
            return new VehicleSafetyRatingService($guzzleClient);
        });
        $response = $this->json('GET', '/vehicles/2013/Ford/Crown Victoria');
        $response
            ->assertOk()
            ->assertExactJson([
                'Count' => 0,
                'Results' =>[]
            ]);
    }

    public function test_result_for_2015_audi_a3()
    {
        $api_response = json_encode([
            'Count' => 2,
            'Message' => "Results returned successfully",
            'Results' =>[
                '0' => array(
                    'VehicleDescription' => "2015 Audi A3 4 DR AWD",
                    'VehicleId' => 9403
                ),
                '1' => [
                    'VehicleDescription' => "2015 Audi A3 4 DR FWD",
                    'VehicleId' => 9408
                ],
            ]
        ]);

        $this->app->bind(VehicleSafetyRatingService::class , function ($app) use ($api_response){
            $mock = new MockHandler([
                new Response(200, [], $api_response)]);

            $handler = HandlerStack::create($mock);
            $guzzleClient = new Client(['handler' => $handler]);
            return new VehicleSafetyRatingService($guzzleClient);
        });
        $response = $this->json('GET', '/vehicles/2015/Audi/A3');
        $response
            ->assertOk()
            ->assertExactJson([
                'Count' => 2,
                'Results' =>[
                        '0' => [
                            'Description' => "2015 Audi A3 4 DR AWD",
                            'VehicleId' => 9403
                        ],
                        '1' => [
                            'Description' => "2015 Audi A3 4 DR FWD",
                            'VehicleId' => 9408
                        ],
                ]
            ]);
    }


}
