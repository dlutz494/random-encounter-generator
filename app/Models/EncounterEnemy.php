<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EncounterEnemy extends Model
{
    use HasFactory;

    protected $table = 'encounter_enemy';

    protected $fillable = [
        'encounter_id',
        'enemy_id',
        'quantity',
    ];

    protected $attributes = [
        'quantity' => 1,
    ];

    public function encounter() : BelongsTo
    {
        return $this->belongsTo(Encounter::class);
    }

    public function enemy() : BelongsTo
    {
        return $this->belongsTo(Enemy::class);
    }
}
