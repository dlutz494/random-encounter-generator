<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEnemyRequest extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'name'             => 'required|unique:enemies|string',
            'statblock'        => 'required|string',
            'challenge_rating' => 'required|string',
        ];
    }
}
