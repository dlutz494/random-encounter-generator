<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEncounterRequest extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'name'        => 'string|unique:encounters',
            'description' => 'string',
            'difficulty'  => 'string',
            'regions'     => 'array',
            'enemies'     => 'array',
        ];
    }
}
