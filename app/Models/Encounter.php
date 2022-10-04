<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Encounter extends Model
{
    use HasFactory;

    protected mixed $name;
    protected mixed $description;
    protected mixed $difficulty;

    protected $table = 'encounters';

    protected $fillable = [
        'name',
        'description',
        'difficulty',
    ];

    public function regions() : BelongsToMany
    {
        return $this->belongsToMany(Region::class, 'encounter_regions');
    }

    public function enemies() : BelongsToMany
    {
        return $this->belongsToMany(Enemy::class, 'encounter_enemies');
    }
}
