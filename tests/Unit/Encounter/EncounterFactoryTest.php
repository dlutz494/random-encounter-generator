<?php

namespace Tests\Unit\Encounter;

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
        $this->markTestSkipped('Need to add region functionality in Encounter factory');
        $count = 5;
        $encounter = Encounter::factory()->withManyRegions($count)->create();

        $this->assertNotEmpty($encounter);
        $this->assertCount($count, $encounter->regions);
    }

    public function test_it_creates_an_encounter_with_many_enemies() : void
    {
        $this->markTestSkipped('Need to add enemy functionality in Encounter factory');
        $count = 5;
        /** @var Encounter $encounter */
        $encounter = Encounter::factory()->withManyEnemies($count)->create();

        $this->assertNotEmpty($encounter);
        $this->assertCount($count, $encounter->enemies);
    }

}
