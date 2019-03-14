<?php

namespace Tests\Feature\Vehicle;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VehiclesWithRatingTest extends TestCase
{

    public function test_response_structure_for_vehicles_with_rating_is_true()
    {
        $response = $this->json('GET','/vehicles/2015/Audi/A3?withRating=true');

        $response->assertOk()
            ->assertJsonStructure([
                'Count',
                'Results' => [
                    '*' => [
                        'CrashRating',
                        'Description',
                        'VehicleId'
                    ]
                ]
            ]);
    }
    public function test_response_structure_for_vehicles_with_rating_is_false_or_banana()
    {
        $responseWithOutRating = $this->json('GET', '/vehicles/2015/Audi/A3');

        $responseWithRatingFalse = $this->json('GET','/vehicles/2015/Audi/A3?withRating=false');
        $responseWithRatingBanana = $this->json('GET','/vehicles/2015/Audi/A3?withRating=banana');

        $responseWithRatingFalse->assertOk()
            ->assertExactJson((array) \GuzzleHttp\json_decode($responseWithOutRating->getContent()));

        $responseWithRatingBanana->assertOk()
            ->assertExactJson((array) \GuzzleHttp\json_decode($responseWithOutRating->getContent()));

    }
}
