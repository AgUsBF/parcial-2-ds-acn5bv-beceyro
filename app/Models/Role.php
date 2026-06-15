<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    /**
     * Atributos asignables
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Relaciones
     */
    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }
}
