<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncounterEnemies extends Model
{
    use HasFactory;

    protected $table = 'encounter_enemies';

    protected $fillable = [
        'encounter_id',
        'enemy_id',
    ];
}
