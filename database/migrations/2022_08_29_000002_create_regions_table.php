<?php

use App\Models\Environment;
use App\Models\Region;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() : void
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('environment')->constrained('environments');
            $table->foreignId('parent_region')->nullable()->constrained('regions');
            $table->timestamps();
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('regions');
    }
};
