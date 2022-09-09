<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RegionResource extends JsonResource
{
    public function toArray($request) : array
    {
        return [
            'id'               => $this->id,
            'name'             => $this->name,
            'environment_type' => $this->environment_type,
            'parent_region'    => $this->parent_region,
        ];
    }
}
