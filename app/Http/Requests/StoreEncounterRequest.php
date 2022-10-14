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
            'name'        => 'required|string|unique:encounters',
            'description' => 'nullable|string',
            'difficulty'  => 'nullable|string',
            'regions'     => 'required|array',
            'enemies'     => 'required|array',
        ];
    }
}
