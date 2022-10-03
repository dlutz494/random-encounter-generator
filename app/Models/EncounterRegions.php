<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncounterRegions extends Model
{
    use HasFactory;

    protected $table = 'encounter_regions';

    protected $fillable = [
        'encounter_id',
        'region_id',
    ];
}
