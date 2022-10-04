<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class EncounterResource extends JsonResource
{
    public function toArray($request) : array|JsonSerializable|Arrayable
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'difficulty'  => $this->difficulty,
            'regions'     => $this->regions,
            'enemies'     => $this->enemies,
        ];
    }
}
