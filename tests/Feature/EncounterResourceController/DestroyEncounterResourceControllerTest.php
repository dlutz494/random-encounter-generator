<?php

namespace Tests\Feature\EncounterResourceController;

use App\Models\Encounter;
use App\Models\Enemy;
use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestroyEncounterResourceControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_destroys_an_encounter() : void
    {
        $region = Region::factory()->create();
        $enemy = Enemy::factory()->create();
        $encounter = Encounter::factory()->hasAttached($region)->hasAttached($enemy)->create();

        $this->assertDatabaseHas('encounters', $encounter->toArray());
        $this->assertDatabaseHas('encounter_region', ['encounter_id' => $encounter->getKey()]);
        $this->assertDatabaseHas('encounter_enemy', ['encounter_id' => $encounter->getKey()]);

        $this->json('DELETE', 'api/encounter/' . $encounter->getKey());

        $this->assertDatabaseMissing('encounters', $encounter->toArray());
        $this->assertDatabaseMissing('encounter_region', ['encounter_id' => $encounter->getKey()]);
        $this->assertDatabaseMissing('encounter_enemy', ['encounter_id' => $encounter->getKey()]);
    }

    public function test_it_returns_405_without_an_id() : void
    {
        $this->json('DELETE', 'api/encounter/')->assertStatus(405);
    }

}
