<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enemies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('statblock')->default('www.dndbeyond.com');
            $table->string('challenge_rating')->default('1/4');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enemies');
    }
};
