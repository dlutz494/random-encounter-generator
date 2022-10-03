<?php

use App\Models\Encounter;
use App\Models\Region;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() : void
    {
        Schema::create('encounter_regions', function (Blueprint $table) {
            $table->id('encounter_region_id');
            $table->foreignIdFor(Region::class, 'region_id');
            $table->foreignIdFor(Encounter::class, 'encounter_id');
            $table->timestamps();
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('encounter_regions');
    }
};
