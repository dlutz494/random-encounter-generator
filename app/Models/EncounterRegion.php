<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EncounterRegion extends Model
{
    use HasFactory;

    protected $table = 'encounter_region';

    protected $fillable = [
        'encounter_id',
        'region_id',
    ];

}
