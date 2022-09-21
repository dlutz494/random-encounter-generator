<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    public function environment() : HasOne
    {
        return $this->hasOne(Environment::class);
    }

    public function parentRegion() : HasOne
    {
        return $this->hasOne(Region::class);
    }

}
