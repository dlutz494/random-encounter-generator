<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EnemyResource extends ResourceCollection
{
    public function toArray($request) : array
    {
        return [
            'id'               => $this->id,
            'name'             => $this->name,
            'statblock'        => $this->statblock,
            'challenge_rating' => $this->challenge_rating,
        ];
    }
}
