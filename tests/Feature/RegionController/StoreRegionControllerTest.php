<?php

namespace Tests\Feature\RegionController;

use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreRegionControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @dataProvider ProvidesValidRegions
     */
    public function test_it_stores_valid_regions($region)
    {
        $this->json('POST', 'api/region', $region)->assertSuccessful();
        $this->assertDatabaseHas('regions', $region);
    }

    /**
     * @dataProvider ProvidesInvalidRegions
     */
    public function test_it_returns_422_with_invalid_regions($region, $status, $expectedResponse) : void
    {
        $response = $this->json('POST', 'api/region', $region);

        $response->assertStatus($status);
        $response->assertSee($expectedResponse);
    }

    public function test_it_returns_422_with_duplicate_name()
    {
        $region = Region::factory()->create();

        $response = $this->json('POST', 'api/region', [
            'name' => $region->name,
            'environment' => $region->environment,
        ]);

        $response->assertStatus(422);
        $response->assertSee('The name has already been taken.');
    }

    public function ProvidesValidRegions() : array
    {
        $validName = 'A Region';
        $validEnvironment = 'An Environment';
        $validParentRegion = 'A Parent Region';

        return [
            'Region with all fields'       => [
                'region' => [
                    'name'          => $validName,
                    'environment'   => $validEnvironment,
                    'parent_region' => $validParentRegion,
                ],
            ],
            'Region with no Parent Region' => [
                'region' => [
                    'name'        => $validName,
                    'environment' => $validEnvironment,
                ],
            ],
        ];
    }

    public function ProvidesInvalidRegions() : array
    {
        $name = 'A Region';
        $environment = 'Test Environment';
        $parentRegion = 'A Parent Region';

        return [
            'Region with no Name' => [
                'region' => [
                    'environment'   => $environment,
                    'parent_region' => $parentRegion,
                ],
                'status' => 422,
                'expectedResponse' => 'The name field is required.'
            ],
            'Name is an integer' => [
                'region' => [
                    'name' => 123,
                    'environment'   => $environment,
                    'parent_region' => $parentRegion,
                ],
                'status' => 422,
                'expectedResponse' => 'The name must be a string.'
            ],
            'Environment is an integer' => [
                'region' => [
                    'name' => $name,
                    'environment'   => 123,
                    'parent_region' => $parentRegion,
                ],
                'status' => 422,
                'expectedResponse' => 'The environment must be a string.'
            ],
            'Parent Region is an integer' => [
                'region' => [
                    'name' => $name,
                    'environment'   => $environment,
                    'parent_region' => 123,
                ],
                'status' => 422,
                'expectedResponse' => 'The parent region must be a string.'
            ],
        ];
    }
}
