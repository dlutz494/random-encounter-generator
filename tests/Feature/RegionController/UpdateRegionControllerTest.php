<?php

namespace Tests\Feature\RegionController;

use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateRegionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_updates_a_region_with_name_and_environment_type() : void
    {
        $region = Region::factory()->create();
        $newRegionName = 'Update Test';
        $newRegionType = 'Urban';

        $response = $this->json('PUT', 'api/region/'.$region->getKey(), [
            'name'             => $newRegionName,
            'environment_type' => $newRegionType,
        ]);

        $response->assertSuccessful();
        $this->assertDatabaseHas('Regions', [
            'name'             => $newRegionName,
            'environment_type' => $newRegionType,
        ]);
    }

    public function test_it_updates_a_region_with_name_and_environment_type_and_parent_region() : void
    {
        $region = Region::factory()->create();
        $newRegionName = 'Update Test';
        $newRegionType = 'Urban';
        $newRegionParentName = 'Parent Update Test';

        $response = $this->json('PUT', 'api/region/'.$region->getKey(), [
            'name'             => $newRegionName,
            'environment_type' => $newRegionType,
            'parent_region'    => $newRegionParentName,
        ]);

        $response->assertSuccessful();
        $this->assertDatabaseHas('Regions', [
            'name'             => $newRegionName,
            'environment_type' => $newRegionType,
            'parent_region'    => $newRegionParentName,
        ]);
    }

}
