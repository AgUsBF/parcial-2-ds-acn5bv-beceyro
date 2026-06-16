<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnimalRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:100|unique:animals,name',
            'birth_date' => 'required|date',
            'sex' => 'required|in:Macho,Hembra',
            'is_sterilized' => 'required|boolean',
            'comment' => 'nullable|text',
            'specie_id' => 'required|exists:species,id',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
