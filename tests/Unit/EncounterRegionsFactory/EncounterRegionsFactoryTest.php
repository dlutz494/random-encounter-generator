<?php

namespace Tests\Unit\EncounterRegionsFactory;

use App\Models\Encounter;
use App\Models\EncounterRegion;
use App\Models\Region;
use Tests\TestCase;

class EncounterRegionsFactoryTest extends TestCase
{
    public function test_it_creates_an_encounter_enemies_relation() : void
    {
        $encounterRegion = EncounterRegion::factory()->create();

        $this->assertNotEmpty($encounterRegion);
        $this->assertNotEmpty($encounterRegion->encounter_id);
        $this->assertNotEmpty($encounterRegion->region_id);
    }

    public function test_it_creates_an_encounter_enemies_relation_with_encounter() : void
    {
        $encounter = Encounter::factory()->create();

        $encounterRegion = EncounterRegion::factory()
            ->withEncounter($encounter)
            ->create();

        $this->assertNotEmpty($encounterRegion);
        $this->assertNotEmpty($encounterRegion->encounter_id);
        $this->assertEquals($encounter->getKey(), $encounterRegion->encounter_id);
        $this->assertNotEmpty($encounterRegion->region_id);
    }

    public function test_it_creates_an_encounter_enemies_relation_with_region() : void
    {
        $region = Region::factory()->create();

        $encounterRegion = EncounterRegion::factory()
            ->withRegion($region)
            ->create();

        $this->assertNotEmpty($encounterRegion);
        $this->assertNotEmpty($encounterRegion->encounter_id);
        $this->assertNotEmpty($encounterRegion->region_id);
        $this->assertEquals($region->getKey(), $encounterRegion->region_id);
    }

    public function test_it_creates_an_encounter_enemies_relation_with_both() : void
    {
        $encounter = Encounter::factory()->create();
        $region = Region::factory()->create();

        $encounterRegion = EncounterRegion::factory()
            ->withEncounter($encounter)
            ->withRegion($region)
            ->create();

        $this->assertNotEmpty($encounterRegion);
        $this->assertNotEmpty($encounterRegion->encounter_id);
        $this->assertEquals($encounter->getKey(), $encounterRegion->encounter_id);
        $this->assertNotEmpty($encounterRegion->region_id);
        $this->assertEquals($region->getKey(), $encounterRegion->region_id);
    }
}
