<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegionRequest extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'name'          => 'required|unique:regions|string',
            'environment'   => 'required|string',
            'parent_region' => 'nullable|string',
        ];
    }
}
