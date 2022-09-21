<?php

namespace Tests\Feature\RegionController;

use App\Models\Environment;
use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowRegionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_a_region() : void
    {
        $regionName = 'A Region';
        $environment = Environment::factory()->create();
        $region = Region::factory()->create([
            'name'        => $regionName,
            'environment' => $environment->getKey(),
        ]);

        $response = $this->json('GET', 'api/region/' . $region->getKey());

        $response->assertSuccessful();
        $response->assertJson(
            [
                'data' => [
                    'name'        => $regionName,
                    'environment' => $environment->getKey(),
                ],
            ]
        );
    }

    public function test_it_returns_a_region_with_parent_region() : void
    {
        $region = Region::factory()->withParentRegion()->create();

        $response = $this->json('GET', 'api/region/' . $region->getKey());

        $response->assertSuccessful();
        $response->assertJson(
            [
                'data' => [
                    'name'          => $region->name,
                    'environment'   => $region->environment,
                    'parent_region' => $region->parent_region,
                ],
            ]
        );
    }

}
