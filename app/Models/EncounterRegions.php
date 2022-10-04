<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EncounterRegions extends Model
{
    use HasFactory;

    protected $table = 'encounter_regions';

    protected $fillable = [
        'encounter_id',
        'region_id',
    ];

    public function encounter() : BelongsTo
    {
        return $this->belongsTo(Encounter::class);
    }

    public function region() : BelongsTo
    {
        return $this->belongsTo(Region::class);
    }
}
