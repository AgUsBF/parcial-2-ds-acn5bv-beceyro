<?php

namespace App\Models;

use App\Models\Specie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Animal extends Model
{
    use HasFactory;

    protected $table = 'animals';

    /**
     * Atributos asignables
     */
    protected $fillable = [
        'name',
        'birth_date',
        'sex',
        'is_sterilized',
        'comment',
    ];

    /**
     * Relaciones
     */
    public function specie()
    {
        return $this->belongsTo(Specie::class, 'specie_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
