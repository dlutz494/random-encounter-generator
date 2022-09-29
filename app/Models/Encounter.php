<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Encounter extends Model
{
    use HasFactory;

    protected mixed $name;
    protected mixed $description;
    protected mixed $regions;
    protected mixed $enemies;
    protected mixed $difficulty;

    protected $table = 'encounters';

    protected $fillable = [
        'name',
        'description',
        'regions',
        'enemies',
        'difficulty',
    ];

    public function regions() : morphToMany
    {
        return $this->morphedByMany(Region::class, 'encounter_regions');
    }

    public function enemies() : morphToMany
    {
        return $this->morphedByMany(Enemy::class, 'encounter_enemies');
    }
}
