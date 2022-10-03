<?php

namespace Tests\Unit\EncounterRegions;

use App\Models\Encounter;
use App\Models\EncounterRegions;
use App\Models\Region;
use Tests\TestCase;

class EncounterRegionsFactoryTest extends TestCase
{
    public function test_it_creates_an_encounter_enemies_relation() : void
    {
        $encounterRegions = EncounterRegions::factory()->create();

        $this->assertNotEmpty($encounterRegions);
        $this->assertNotEmpty($encounterRegions->encounter_id);
        $this->assertNotEmpty($encounterRegions->region_id);
    }

    public function test_it_creates_an_encounter_enemies_relation_with_encounter() : void
    {
        $encounter = Encounter::factory()->create();

        $encounterRegions = EncounterRegions::factory()
            ->withEncounter($encounter)
            ->create();

        $this->assertNotEmpty($encounterRegions);
        $this->assertNotEmpty($encounterRegions->encounter_id);
        $this->assertEquals($encounter->getKey(), $encounterRegions->encounter_id);
        $this->assertNotEmpty($encounterRegions->region_id);
    }

    public function test_it_creates_an_encounter_enemies_relation_with_region() : void
    {
        $region = Region::factory()->create();

        $encounterRegions = EncounterRegions::factory()
            ->withRegion($region)
            ->create();

        $this->assertNotEmpty($encounterRegions);
        $this->assertNotEmpty($encounterRegions->encounter_id);
        $this->assertNotEmpty($encounterRegions->region_id);
        $this->assertEquals($region->getKey(), $encounterRegions->region_id);
    }

    public function test_it_creates_an_encounter_enemies_relation_with_both() : void
    {
        $encounter = Encounter::factory()->create();
        $region = Region::factory()->create();

        $encounterRegions = EncounterRegions::factory()
            ->withEncounter($encounter)
            ->withRegion($region)
            ->create();

        $this->assertNotEmpty($encounterRegions);
        $this->assertNotEmpty($encounterRegions->encounter_id);
        $this->assertEquals($encounter->getKey(), $encounterRegions->encounter_id);
        $this->assertNotEmpty($encounterRegions->region_id);
        $this->assertEquals($region->getKey(), $encounterRegions->region_id);
    }
}
