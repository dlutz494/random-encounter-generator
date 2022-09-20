<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEnemyRequest extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'name'             => 'string|unique:enemies|nullable',
            'statblock'        => 'string|nullable',
            'challenge_rating' => 'string|nullable',
        ];
    }
}
