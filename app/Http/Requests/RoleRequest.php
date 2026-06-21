<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        $role = $this->route('role');
        $roleId = $role instanceof Role ? $role->id : $role;

        return [
            'name' => 'required|string|max:100|unique:roles,name,'.($roleId ?? 'NULL'),
        ];
    }
}
