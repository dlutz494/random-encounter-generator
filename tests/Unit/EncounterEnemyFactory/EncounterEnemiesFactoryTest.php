<?php

namespace Tests\Unit\EncounterEnemyFactory;

use App\Models\Encounter;
use App\Models\EncounterEnemy;
use App\Models\Enemy;
use Tests\TestCase;

class EncounterEnemiesFactoryTest extends TestCase
{
    public function test_it_creates_an_encounter_enemies_relation() : void
    {
        $encounterEnemy = EncounterEnemy::factory()->create();

        $this->assertNotEmpty($encounterEnemy);
        $this->assertNotEmpty($encounterEnemy->encounter_id);
        $this->assertNotEmpty($encounterEnemy->enemy_id);
    }

    public function test_it_creates_an_encounter_enemies_relation_with_encounter() : void
    {
        $encounter = Encounter::factory()->create();

        $encounterEnemy = EncounterEnemy::factory()
            ->for($encounter)
            ->create();

        $this->assertNotEmpty($encounterEnemy);
        $this->assertNotEmpty($encounterEnemy->encounter_id);
        $this->assertNotEmpty($encounterEnemy->enemy_id);
    }

    public function test_it_creates_an_encounter_enemies_relation_with_enemy() : void
    {
        $enemy = Enemy::factory()->create();

        $encounterEnemy = EncounterEnemy::factory()
            ->for($enemy)
            ->create();

        $this->assertNotEmpty($encounterEnemy);
        $this->assertNotEmpty($encounterEnemy->encounter_id);
        $this->assertNotEmpty($encounterEnemy->enemy_id);
        $this->assertEquals($enemy->getKey(), $encounterEnemy->enemy_id);
    }

    public function test_it_creates_an_encounter_enemies_relation_with_both() : void
    {
        $encounter = Encounter::factory()->create();
        $enemy = Enemy::factory()->create();

        $encounterEnemy = EncounterEnemy::factory()
            ->for($encounter)
            ->for($enemy)
            ->create();

        $this->assertNotEmpty($encounterEnemy);
        $this->assertNotEmpty($encounterEnemy->encounter_id);
        $this->assertNotEmpty($encounterEnemy->enemy_id);
        $this->assertEquals($encounter->getKey(), $encounterEnemy->encounter_id);
        $this->assertEquals($enemy->getKey(), $encounterEnemy->enemy_id);
    }

}
