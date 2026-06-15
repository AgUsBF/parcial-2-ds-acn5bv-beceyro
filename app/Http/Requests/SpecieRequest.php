<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpecieRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:100|unique:species,name',
        ];
    }
}
