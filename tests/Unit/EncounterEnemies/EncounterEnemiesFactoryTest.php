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
        $encounter = Encounter::factory()->create();

        $encounterEnemies = EncounterEnemies::factory()
            ->withEncounter($encounter)
            ->create();

        $this->assertNotEmpty($encounterEnemies);
        $this->assertNotEmpty($encounterEnemies->encounter_id);
        $this->assertEquals($encounter->getKey(), $encounterEnemies->encounter_id);
        $this->assertNotEmpty($encounterEnemies->enemy_id);
    }

    public function test_it_creates_an_encounter_enemies_relation_with_enemy() : void
    {
        $enemy = Enemy::factory()->create();

        $encounterEnemies = EncounterEnemies::factory()
            ->withEnemy($enemy)
            ->create();

        $this->assertNotEmpty($encounterEnemies);
        $this->assertNotEmpty($encounterEnemies->encounter_id);
        $this->assertNotEmpty($encounterEnemies->enemy_id);
        $this->assertEquals($enemy->getKey(), $encounterEnemies->enemy_id);
    }

    public function test_it_creates_an_encounter_enemies_relation_with_both() : void
    {
        $encounter = Encounter::factory()->create();
        $enemy = Enemy::factory()->create();

        $encounterEnemies = EncounterEnemies::factory()
            ->withEncounter($encounter)
            ->withEnemy($enemy)
            ->create();

        $this->assertNotEmpty($encounterEnemies);
        $this->assertNotEmpty($encounterEnemies->encounter_id);
        $this->assertEquals($encounter->getKey(), $encounterEnemies->encounter_id);
        $this->assertNotEmpty($encounterEnemies->enemy_id);
        $this->assertEquals($enemy->getKey(), $encounterEnemies->enemy_id);
    }

}
