<?php

use App\Models\Enemy;
use App\Models\Region;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up() : void
    {
        Schema::create('encounters', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->longText('description')->nullable();
            $table->string('difficulty')->nullable();
            $table->timestamps();
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('encounters');
    }
};
