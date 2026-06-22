<?php

namespace App\Http\Requests;

use App\Models\Specie;
use Illuminate\Foundation\Http\FormRequest;

class SpecieRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        $specie = $this->route('species');
        $specieId = $specie instanceof Specie ? $specie->id : $specie;

        return [
            'name' => 'required|string|max:100|unique:species,name,'.($specieId ?? 'NULL'),
        ];
    }
}
