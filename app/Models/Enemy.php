<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Enemy extends Model
{
    use HasFactory;

    protected string $name;
    protected string $statblock;
    protected string $challenge_rating;

    protected $table = 'enemies';

    protected $fillable = [
        'name',
        'statblock',
        'challenge_rating',
    ];

    public function encounters() : morphToMany
    {
        return $this->morphToMany(Encounter::class, 'encounter_enemies');
    }
}
