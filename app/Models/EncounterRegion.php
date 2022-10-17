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

    public function encounter() : BelongsTo
    {
        return $this->belongsTo(Encounter::class, ownerKey: 'encounter_id');
    }

    public function region() : BelongsTo
    {
        return $this->belongsTo(Region::class, ownerKey: 'region_id');
    }
}
