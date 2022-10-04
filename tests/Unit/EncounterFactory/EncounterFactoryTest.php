<?php

namespace Tests\Unit\EncounterFactory;

use App\Models\Encounter;
use Tests\TestCase;

class EncounterFactoryTest extends TestCase
{
    public function test_it_creates_an_encounter() : void
    {
        $encounter = Encounter::factory()->create();

        $this->assertNotEmpty($encounter);
        $this->assertNotEmpty($encounter->name);
        $this->assertNotEmpty($encounter->description);
        $this->assertNotEmpty($encounter->difficulty);
    }

    public function test_it_creates_an_encounter_with_many_regions() : void
    {
        $count = 5;
        $encounter = Encounter::factory()->hasRegions($count)->create();

        $this->assertNotEmpty($encounter);
        $this->assertCount($count, $encounter->regions);
    }

    public function test_it_creates_an_encounter_with_many_enemies() : void
    {
        $count = 5;
        $encounter = Encounter::factory()->hasEnemies($count)->create();

        $this->assertNotEmpty($encounter);
        $this->assertCount($count, $encounter->enemies);
    }

}
