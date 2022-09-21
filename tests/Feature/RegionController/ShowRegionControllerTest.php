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
        $environment = 'Desert';
        $region = Region::factory()->create([
            'name'        => $regionName,
            'environment' => $environment,
        ]);

        $response = $this->json('GET', 'api/region/' . $region->getKey());

        $response->assertSuccessful();
        $response->assertJson(
            [
                'data' => [
                    'name'        => $regionName,
                    'environment' => $environment,
                ],
            ]
        );
    }

    public function test_it_returns_a_region_with_parent_region() : void
    {
        $regionName = 'A Region';
        $environment = 'Desert';
        $parentRegion = 'A Parent Region';
        $region = Region::factory()->create([
            'name'          => $regionName,
            'environment'   => $environment,
            'parent_region' => $parentRegion,
        ]);

        $response = $this->json('GET', 'api/region/' . $region->getKey());

        $response->assertSuccessful();
        $response->assertJson(
            [
                'data' => [
                    'name'          => $regionName,
                    'environment'   => $environment,
                    'parent_region' => $parentRegion,
                ],
            ]
        );
    }

}
