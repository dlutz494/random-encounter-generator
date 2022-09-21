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
            'environment'   => 'required|exists:environments,id|numeric',
            'parent_region' => 'nullable|exists:regions,id|numeric',
        ];
    }
}
