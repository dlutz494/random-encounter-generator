<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRegionRequest extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'name'          => 'string|unique:regions',
            'environment'   => 'string',
            'parent_region' => 'nullable|string',
        ];
    }
}
