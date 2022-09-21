<?php

namespace Tests\Feature\RegionController;

use App\Models\Environment;
use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreRegionControllerTest extends TestCase
{
    use RefreshDatabase;

    protected int $environmentId = 1;
    protected int $parentRegionId = 1;

    protected function setUp() : void
    {
        parent::setUp();
        Environment::factory()->create([
            'id' => $this->environmentId
        ]);
        Region::factory()->create([
            'id' => $this->parentRegionId
        ]);
    }

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
    public function test_it_returns_422_with_invalid_regions($region, $status, $errors) : void
    {
        $response = $this->json('POST', 'api/region', $region);

        $response->assertStatus($status);
        $response->assertJsonFragment($errors);
    }

    public function test_it_returns_422_with_duplicate_name()
    {
        $region = Region::factory()->withUniqueName()->create();

        $response = $this->json('POST', 'api/region', [
            'name'        => $region->name,
            'environment' => $region->environment,
        ]);

        $response->assertStatus(422);
        $response->assertJsonFragment(['The name has already been taken.']);
    }

    public function ProvidesValidRegions() : array
    {
        $validName = 'A Region';
        $validEnvironment = $this->environmentId;
        $validParentRegion = $this->parentRegionId;

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
        $validName = 'A Region';
        $validEnvironment = $this->environmentId;
        $validParentRegion = $this->parentRegionId;

        return [
            'Region with no Name'       => [
                'region' => [
                    'environment'   => $validEnvironment,
                    'parent_region' => $validParentRegion,
                ],
                'status' => 422,
                'errors' => [
                    'The name field is required.',
                ],
            ],
            'Name is an integer'        => [
                'region' => [
                    'name'          => 123,
                    'environment'   => $validEnvironment,
                    'parent_region' => $validParentRegion,
                ],
                'status' => 422,
                'errors' => [
                    'The name must be a string.',
                ],
            ],
            'Environment is a string'   => [
                'region' => [
                    'name'          => $validName,
                    'environment'   => 'Environment',
                    'parent_region' => $validParentRegion,
                ],
                'status' => 422,
                'errors' => [
                    'The environment must be a number.',
                ],
            ],
            'Parent Region is a string' => [
                'region' => [
                    'name'          => $validName,
                    'environment'   => $validEnvironment,
                    'parent_region' => 'Parent Region',
                ],
                'status' => 422,
                'errors' => [
                    'The parent region must be a number.',
                ],
            ],
        ];
    }

}
