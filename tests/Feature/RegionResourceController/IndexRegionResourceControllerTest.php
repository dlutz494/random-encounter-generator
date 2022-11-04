<?php

namespace Tests\Feature\RegionResourceController;

use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexRegionResourceControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_a_region() : void
    {
        $region = Region::factory()->create();

        $response = $this->json('GET', 'api/region');

        $response->assertSuccessful();
        $response->assertJson([
            [
                'name'        => $region->name,
                'environment' => $region->environment,
            ],
        ]);
    }

    public function test_it_returns_two_regions_with_parent_region() : void
    {
        $region = Region::factory()->withParentRegion()->create();

        $response = $this->json('GET', 'api/region');

        $response->assertSuccessful();
        $response->assertJson([
            [
                'name'        => Region::find($region->parent_region)->name,
                'environment' => Region::find($region->parent_region)->environment,
            ],
            [
                'name'          => $region->name,
                'environment'   => $region->environment,
                'parent_region' => $region->parent_region,
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
                'name'        => $regions[0]->name,
                'environment' => $regions[0]->environment,
            ],
            [
                'name'        => $regions[1]->name,
                'environment' => $regions[1]->environment,
            ],
            [
                'name'        => $regions[2]->name,
                'environment' => $regions[2]->environment,
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
