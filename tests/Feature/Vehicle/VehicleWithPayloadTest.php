<?php

namespace Tests\Feature\Vehicle;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VehicleWithPayloadTest extends TestCase
{

    public function test_with_2015_audi_a3_payload()
    {
        $payLoad = [
            'modelYear' => 2015,
            'manufacturer' => 'Audi',
            'model' => 'A3'
        ];

        $response = $this->json('POST','/vehicles', $payLoad);
        $response->assertOk()
            ->assertJsonStructure([
                'Count',
                'Results'
            ]);

    }

    public function test_with_2015_toyota_yaris_payload()
    {
        $payLoad = [
            'modelYear' => 2015,
            'manufacturer' => 'Toyoto',
            'model' => 'Yaris'
        ];

        $response = $this->json('POST','/vehicles', $payLoad);
        $response->assertOk()
            ->assertJsonStructure([
                'Count',
                'Results'
            ]);

    }

    public function test_with_honda_accord_payload()
    {
        $payLoad = [
            'manufacturer' => 'Honda',
            'model' => 'Accord'
        ];

        $response = $this->json('POST','/vehicles', $payLoad);
        $response
            ->assertOk()
            ->assertExactJson([
                'Count' => 0,
                'Results' =>[]
            ]);
    }

    public function test_with_invalid_year_payload()
    {
        $payLoad = [
            'modelYear' => 1025,
            'manufacturer' => 'Toyoto',
            'model' => 'Yaris'
        ];
        $response = $this->json('POST','/vehicles', $payLoad);
        $response
            ->assertOk()
            ->assertExactJson([
                'Count' => 0,
                'Results' =>[]
            ]);
    }
}
