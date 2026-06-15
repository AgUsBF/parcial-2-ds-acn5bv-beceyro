<?php

namespace App\Models;

use App\Models\Animal;
use Illuminate\Database\Eloquent\Model;

class Specie extends Model
{
    protected $table = 'species';

    /**
     * Atributos asignables
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Relaciones
     */
    public function animals()
    {
        return $this->hasMany(Animal::class, 'specie_id', 'id');
    }
}
