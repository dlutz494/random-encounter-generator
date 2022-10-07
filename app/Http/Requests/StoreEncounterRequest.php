<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEncounterRequest extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'name'        => 'string|required|unique:encounters',
            'description' => 'string|nullable',
            'difficulty'  => 'string|nullable',
            'regions'     => 'array|required',
            'enemies'     => 'array|required',
        ];
    }
}
