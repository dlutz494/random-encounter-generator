<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Region extends Model
{
    use HasFactory;

    protected string $name;
    protected string $environment;
    protected string $parent_region;

    protected $table = 'regions';

    protected $fillable = [
        'name',
        'environment',
        'parent_region',
    ];

    protected $hidden = [
        'pivot',
    ];

    public function environment() : HasOne
    {
        return $this->hasOne(Environment::class);
    }

    public function parentRegion() : HasOne
    {
        return $this->hasOne(Region::class);
    }

    public function childRegion() : BelongsTo
    {
        return $this->belongsTo(Region::class, 'parent_region');
    }

    public function encounters() : BelongsToMany
    {
        return $this->belongsToMany(Encounter::class, 'encounter_enemies');
    }
}
