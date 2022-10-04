<?php

namespace Tests\Unit\EncounterEnemies;

use App\Models\Encounter;
use App\Models\EncounterEnemies;
use App\Models\Enemy;
use Tests\TestCase;

class EncounterEnemiesFactoryTest extends TestCase
{
    public function test_it_creates_an_encounter_enemies_relation() : void
    {
        $encounterEnemies = EncounterEnemies::factory()->create();

        $this->assertNotEmpty($encounterEnemies);
        $this->assertNotEmpty($encounterEnemies->encounter_id);
        $this->assertNotEmpty($encounterEnemies->enemy_id);
    }

    public function test_it_creates_an_encounter_enemies_relation_with_encounter() : void
    {
        $encounterEnemies = EncounterEnemies::factory()
            ->hasEncounter()
            ->create();

        $this->assertNotEmpty($encounterEnemies);
        $this->assertNotEmpty($encounterEnemies->encounter_id);
        $this->assertNotEmpty($encounterEnemies->enemy_id);
    }

    public function test_it_creates_an_encounter_enemies_relation_with_enemy() : void
    {
        $encounterEnemies = EncounterEnemies::factory()
            ->hasEnemy()
            ->create();

        $this->assertNotEmpty($encounterEnemies);
        $this->assertNotEmpty($encounterEnemies->encounter_id);
        $this->assertNotEmpty($encounterEnemies->enemy_id);
    }

    public function test_it_creates_an_encounter_enemies_relation_with_both() : void
    {
        $encounter = Encounter::factory()->create();
        $enemy = Enemy::factory()->create();

        $encounterEnemies = EncounterEnemies::factory()
            ->hasEncounter($encounter)
            ->hasEnemy()
            ->create();

        $this->assertNotEmpty($encounterEnemies);
        $this->assertNotEmpty($encounterEnemies->encounter_id);
        $this->assertNotEmpty($encounterEnemies->enemy_id);
    }

}
