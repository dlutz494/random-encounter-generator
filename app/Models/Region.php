<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}
