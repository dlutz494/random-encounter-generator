<?php

namespace Tests\Feature\EncounterResourceController;

use App\Models\Encounter;
use App\Models\Enemy;
use App\Models\Region;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class StoreEncounterResourceControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $name;
    private string $description;
    private string $difficulty;
    private Region|Collection $regions;
    private Enemy|Collection $enemies;

    public function test_it_stores_an_encounter_with_all_fields() : void
    {
        $response = $this->json('POST', 'api/encounter', [
            'name'        => $this->name,
            'description' => $this->description,
            'difficulty'  => $this->difficulty,
            'regions'     => $this->regions,
            'enemies'     => $this->enemies,
        ]);

        $encounter = Encounter::first();
        $response->assertSuccessful();
        $this->assertDatabaseHas('encounters', [
            'name'        => $this->name,
            'description' => $this->description,
            'difficulty'  => $this->difficulty,
        ]);
        foreach ($this->regions as $region) {
            $this->assertDatabaseHas('encounter_region', [
                'encounter_id' => $encounter->getKey(),
                'region_id'    => $region->getKey(),
            ]);
        }
        foreach ($this->enemies as $enemy) {
            $this->assertDatabaseHas('encounter_enemy', [
                'encounter_id' => $encounter->getKey(),
                'enemy_id'     => $enemy->getKey(),
                'quantity'     => 1,
            ]);
        }
    }

    public function test_it_stores_an_encounter_without_a_description() : void
    {
        $response = $this->json('POST', 'api/encounter', [
            'name'       => $this->name,
            'difficulty' => $this->difficulty,
            'regions'    => $this->regions,
            'enemies'    => $this->enemies,
        ]);

        $encounter = Encounter::first();
        $response->assertSuccessful();
        $this->assertDatabaseHas('encounters', [
            'name'        => $this->name,
            'description' => null,
            'difficulty'  => $this->difficulty,
        ]);
        foreach ($this->regions as $region) {
            $this->assertDatabaseHas('encounter_region', [
                'encounter_id' => $encounter->getKey(),
                'region_id'    => $region->getKey(),
            ]);
        }
        foreach ($this->enemies as $enemy) {
            $this->assertDatabaseHas('encounter_enemy', [
                'encounter_id' => $encounter->getKey(),
                'enemy_id'     => $enemy->getKey(),
                'quantity'     => 1,
            ]);
        }
    }

    public function test_it_stores_an_encounter_without_a_difficulty() : void
    {
        $payload = [
            'name'        => $this->name,
            'description' => $this->description,
            'regions'     => $this->regions,
            'enemies'     => $this->enemies,
        ];
        $response = $this->getResponse($payload);

        $encounter = Encounter::first();
        $response->assertSuccessful();
        $this->assertDatabaseHas('encounters', [
            'name'        => $this->name,
            'description' => $this->description,
            'difficulty'  => null,
        ]);
        foreach ($this->regions as $region) {
            $this->assertDatabaseHas('encounter_region', [
                'encounter_id' => $encounter->getKey(),
                'region_id'    => $region->getKey(),
            ]);
        }
        foreach ($this->enemies as $enemy) {
            $this->assertDatabaseHas('encounter_enemy', [
                'encounter_id' => $encounter->getKey(),
                'enemy_id'     => $enemy->getKey(),
                'quantity'     => 1,
            ]);
        }
    }

    public function getResponse(array $payload) : TestResponse
    {
        return $this->json('POST', 'api/encounter', $payload);
    }

    public function test_it_does_not_store_an_encounter_with_no_name() : void
    {
        $payload = [
            'description' => $this->description,
            'difficulty'  => $this->difficulty,
            'regions'     => $this->regions,
            'enemies'     => $this->enemies,
        ];

        $response = $this->getResponse($payload);

        $response->assertUnprocessable()->assertSee('The name field is required');
    }

    public function test_it_does_not_store_an_encounter_with_no_regions() : void
    {
        $payload = [
            'name'        => $this->name,
            'description' => $this->description,
            'difficulty'  => $this->difficulty,
            'enemies'     => $this->enemies,
        ];

        $response = $this->json('POST', 'api/encounter', $payload);

        $response->assertUnprocessable()->assertSee('The regions field is required.');
    }

    public function test_it_does_not_store_an_encounter_with_no_enemies() : void
    {
        $payload = [
            'name'        => $this->name,
            'description' => $this->description,
            'difficulty'  => $this->difficulty,
            'regions'     => $this->regions,
        ];
        $response = $this->getResponse($payload);

        $response->assertUnprocessable()->assertSee('The enemies field is required.');
    }

    protected function setUp() : void
    {
        parent::setUp();
        $this->name = 'Store Test';
        $this->description = 'A test encounter.';
        $this->difficulty = 'Trivial';
        $this->regions = Region::factory(1)->create();
        $this->enemies = Enemy::factory(3)->create();
    }

}
