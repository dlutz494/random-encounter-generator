<?php

namespace Tests\Feature\RegionController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreRegionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_stores_a_region_with_name_and_environment_type() : void
    {
        $regionName = 'Store Test';
        $environment = 'Forest';

        $response = $this->json('POST', 'api/region', [
            'name'        => $regionName,
            'environment' => $environment,
        ]);

        $response->assertSuccessful();
        $this->assertDatabaseHas('regions', [
            'name'        => $regionName,
            'environment' => $environment,
        ]);
    }

    public function test_it_stores_a_region_with_name_and_environment_type_and_parent_region() : void
    {
        $regionName = 'Store Test';
        $environment = 'Forest';
        $regionParentName = 'Parent Store Test';

        $response = $this->json('POST', 'api/region', [
            'name'          => $regionName,
            'environment'   => $environment,
            'parent_region' => $regionParentName,
        ]);

        $response->assertSuccessful();
        $this->assertDatabaseHas('regions', [
            'name'          => $regionName,
            'environment'   => $environment,
            'parent_region' => $regionParentName,
        ]);
    }

    public function test_it_does_not_store_a_region_without_name() : void
    {
        $environment = 'Forest';

        $response = $this->json('POST', 'api/region', [
            'environment' => $environment,
        ]);

        $response->assertNotFound();
    }

}
