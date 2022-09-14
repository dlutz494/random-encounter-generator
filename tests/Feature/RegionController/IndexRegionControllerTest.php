<?php

namespace Tests\Feature\RegionController;

use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexRegionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_a_region() : void
    {
        $region = Region::factory()->create();

        $response = $this->json('GET', 'api/region');

        $response->assertSuccessful();
        $response->assertJson([
            [
                'name'             => $region->name,
                'environment_type' => $region->environment_type,
            ],
        ]);
    }

    public function test_it_returns_a_region_with_parent_region() : void
    {
        $region = Region::factory()->withParentRegion()->create();

        $response = $this->json('GET', 'api/region');

        $response->assertSuccessful();
        $response->assertJson([
            [
                'name'             => $region->name,
                'environment_type' => $region->environment_type,
                'parent_region'    => $region->parent_region,
            ],
        ]);
    }


    public function test_it_returns_multiple_regions() : void
    {
        $regions = Region::factory(3)->create();

        $response = $this->json('GET', 'api/region');

        $response->assertSuccessful();
        $response->assertJson([
            [
                'name'             => $regions[0]->name,
                'environment_type' => $regions[0]->environment_type,
            ],
            [
                'name'             => $regions[1]->name,
                'environment_type' => $regions[1]->environment_type,
            ],
            [
                'name'             => $regions[2]->name,
                'environment_type' => $regions[2]->environment_type,
            ],
        ]);
    }

    public function test_it_returns_no_regions() : void
    {
        $response = $this->json('GET', 'api/region');

        $response->assertSuccessful();
        $response->assertJson([]);
    }
}
