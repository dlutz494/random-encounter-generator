<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Environment extends Model
{
    use HasFactory;

    protected string $name;

    protected $table = 'environments';

    protected $fillable = [
        'name',
    ];

    protected $attributes = [
        'name' => 'Forest',
    ];
}
