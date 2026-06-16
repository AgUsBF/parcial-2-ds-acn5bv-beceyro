<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'user_id' => 'required|exists:users,id',
            'animal_id' => 'required|exists:animals,id',
        ];
    }
}
