<?php

namespace Tests\Feature\EncounterResourceController;

use App\Models\Encounter;
use App\Models\EncounterEnemy;
use App\Models\EncounterRegion;
use App\Models\Enemy;
use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class UpdateEncounterResourceControllerTest extends TestCase
{
    use RefreshDatabase;

    protected Encounter $encounter;
    protected array $regions = [];
    protected array $enemies = [];

    public function test_it_updates_an_encounter() : void
    {
        $name = 'Update Test ' . uniqid();
        $regions = [Region::factory()->create()->getKey()];
        $enemies = [Enemy::factory()->create()->getKey()];
        $payload = [
            'name'        => $name,
            'description' => 'A test encounter',
            'difficulty'  => 'Trivial',
            'regions'     => $regions,
            'enemies'     => $enemies,
        ];

        $response = $this->getResponse($payload);

        $response->assertSuccessful();
        $this->assertDatabaseHas('encounters', [
            'name'        => $name,
            'description' => 'A test encounter',
            'difficulty'  => 'Trivial',
        ]);
        $this->assertDatabaseHas('encounter_region', [
            'region_id' => $regions[0],
        ]);
        $this->assertDatabaseHas('encounter_enemy', [
            'enemy_id' => $enemies[0],
        ]);
    }

    public function getResponse(array $payload) : TestResponse
    {
        return $this->json('PUT', 'api/encounter/' . $this->encounter->getKey(), $payload);
    }

    public function test_it_returns_unprocessable_with_duplicate_name() : void
    {
        $name = 'Update Test ' . uniqid();
        Encounter::factory()->create([
            'name' => $name,
        ]);

        $response = $this->getResponse(['name' => $name]);

        $response->assertUnprocessable();
        $response->assertSee('The name has already been taken.');
    }

    /**
     * @dataProvider ProvidesValidPayloads
     */
    public function test_it_returns_success_with_valid_payloads($payload) : void
    {
        $response = $this->getResponse($payload);

        $response->assertSuccessful();
    }

    public function test_it_returns_success_with_valid_regions() : void
    {
        $response = $this->getResponse(['regions' => $this->regions]);

        $response->assertSuccessful();
    }

    public function test_it_returns_success_with_valid_enemies() : void
    {
        $response = $this->getResponse(['enemies' => $this->enemies]);

        $response->assertSuccessful();
    }

    /**
     * @dataProvider ProvidesInvalidPayloads
     */
    public function test_it_returns_unprocessable_with_invalid_payloads($payload, $errors) : void
    {
        $response = $this->getResponse($payload);

        $response->assertUnprocessable()->assertSee($errors);
    }

    public function ProvidesValidPayloads() : array
    {
        $name = 'Update encounter';
        $description = 'A test encounter';
        $difficulty = 'Trivial';

        return [
            'Name only'        => [
                'payload' => [
                    'name' => $name,
                ],
            ],
            'Description only' => [
                'payload' => [
                    'description' => $description,
                ],
            ],
            'Difficulty only'  => [
                'payload' => [
                    'difficulty' => $difficulty,
                ],
            ],
            'All fields'       => [
                'payload' => [
                    'name'        => $name,
                    'description' => $description,
                    'difficulty'  => $difficulty,
                ],
            ],
        ];
    }

    public function ProvidesInvalidPayloads() : array
    {
        return [
            'Name is an integer'        => [
                'payload' => [
                    'name' => 123,
                ],
                'errors'  => [
                    'The name must be a string',
                ],
            ],
            'Description is an integer' => [
                'payload' => [
                    'description' => 123,
                ],
                'errors'  => [
                    'The description must be a string',
                ],
            ],
            'Difficulty is an integer'  => [
                'payload' => [
                    'difficulty' => 123,
                ],
                'errors'  => [
                    'The difficulty must be a string',
                ],
            ],
            'Regions is an integer'     => [
                'payload' => [
                    'regions' => 123,
                ],
                'errors'  => [
                    'The regions must be an array',
                ],
            ],
            'Enemies is an integer'     => [
                'payload' => [
                    'enemies' => 123,
                ],
                'errors'  => [
                    'The enemies must be an array',
                ],
            ],
            'All fields are invalid'    => [
                'payload' => [
                    'name'        => 123,
                    'description' => 123,
                    'difficulty'  => 123,
                    'regions'     => 123,
                    'enemies'     => 123,
                ],
                'errors'  => [
                    'The name must be a string. (and 4 more errors)',
                ],
            ],
        ];
    }

    protected function setUp() : void
    {
        parent::setUp();

        $this->enemies = [];
        foreach (Enemy::factory(3)->create() as $enemy) {
            $this->enemies[] = $enemy->getKey();
        }

        $this->regions = [];
        foreach (Region::factory(3)->create() as $region) {
            $this->regions[] = $region->getKey();
        }

        $this->encounter = Encounter::factory()->create();
        EncounterRegion::factory()->withEncounter($this->encounter)->create();
        EncounterEnemy::factory()->withEncounter($this->encounter)->create();
    }

}
