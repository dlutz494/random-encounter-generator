<?php

use App\Models\Encounter;
use App\Models\Region;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() : void
    {
        Schema::create('encounter_region', function (Blueprint $table) {
            $table->id('encounter_region_id');
            $table->foreignIdFor(Encounter::class);
            $table->foreign('encounter_id')
                ->references('id')
                ->on('encounters')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(Region::class);
            $table->foreign('region_id')
                ->references('id')
                ->on('regions')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('encounter_region');
    }
};
