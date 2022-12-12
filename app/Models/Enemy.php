<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    protected $attributes = [
        'statblock'        => 'www.dndbeyond.com',
        'challenge_rating' => '1/8',
    ];

    protected $hidden = [
        'pivot',
    ];

    public function encounters() : BelongsToMany
    {
        return $this->belongsToMany(Encounter::class, 'encounter_enemy');
    }
}
