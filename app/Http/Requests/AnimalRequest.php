<?php

namespace App\Http\Requests;

use App\Models\Animal;
use Illuminate\Foundation\Http\FormRequest;

class AnimalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $animal = $this->route('animal');
        $animalId = $animal instanceof Animal ? $animal->id : $animal;

        return [
            'name' => 'required|string|max:100|unique:animals,name,'.($animalId ?? 'NULL'),
            'birth_date' => 'required|date',
            'sex' => 'required|in:Macho,Hembra',
            'is_sterilized' => 'required|boolean',
            'comment' => 'nullable|string',
            'specie_id' => 'required|exists:species,id',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
