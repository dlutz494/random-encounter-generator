<?php

namespace Tests\Feature\RegionController;

use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowRegionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_a_region() : void
    {
        $regionName = 'A Region';
        $regionType = 'Desert';
        $region = Region::factory()->create([
            'name'             => $regionName,
            'environment_type' => $regionType,
        ]);

        $response = $this->json('GET', 'api/region/' . $region->getKey());

        $response->assertSuccessful();
        $response->assertJson(
            [
                'data' => [
                    'name'             => $regionName,
                    'environment_type' => $regionType,
                ],
            ]
        );
    }
}
