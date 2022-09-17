<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EnvironmentResource extends ResourceCollection
{
    public function toArray($request) : array
    {
        return [
            'id'   => $this->id,
            'name' => $this->name,
        ];
    }
}
