<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Encounter extends Model
{
    use HasFactory;

    protected string $name;
    protected string $description;
    protected string $difficulty;
    protected mixed $regions;
    protected mixed $enemies;

    protected $table = 'encounters';

    protected $fillable = [
        'name',
        'description',
        'difficulty',
    ];

    protected $casts = [
        'name'        => 'string',
        'description' => 'string',
        'difficulty'  => 'string',
    ];

    protected $attributes = [
        'description' => 'An encounter.',
        'difficulty'  => 'Trivial',
    ];

    public function regions() : BelongsToMany
    {
        return $this->belongsToMany(Region::class, 'encounter_region')->withTimestamps();
    }

    public function enemies() : BelongsToMany
    {
        return $this->belongsToMany(Enemy::class)->using(EncounterEnemy::class)
            ->withPivot('quantity')->withTimestamps();
    }
}
