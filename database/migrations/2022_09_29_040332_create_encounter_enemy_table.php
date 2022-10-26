<?php

use App\Models\Encounter;
use App\Models\Enemy;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() : void
    {
        Schema::create('encounter_enemy', function (Blueprint $table) {
            $table->id('encounter_enemy_id');
            $table->foreignIdFor(Encounter::class);
            $table->foreign('encounter_id')
                ->references('id')
                ->on('encounters')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(Enemy::class);
            $table->foreign('enemy_id')
                ->references('id')
                ->on('enemies')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->integer('quantity', unsigned: true)->default(1);
            $table->timestamps();
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('encounter_enemy');
    }
};
