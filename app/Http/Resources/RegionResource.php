<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RegionResource extends JsonResource
{
    public function toArray($request) : array
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'environment'   => $this->environment,
            'parent_region' => $this->parent_region,
        ];
    }
}
