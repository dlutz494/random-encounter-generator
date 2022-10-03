<?php

use App\Models\Encounter;
use App\Models\Enemy;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() : void
    {
        Schema::create('encounter_enemies', function (Blueprint $table) {
            $table->id('encounter_enemy_id');
            $table->foreignIdFor(Encounter::class, 'encounter_id');
            $table->foreignIdFor(Enemy::class, 'enemy_id');
            $table->timestamps();
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('encounter_enemies');
    }
};
