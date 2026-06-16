<?php

namespace App\Models;

use App\Models\Specie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';

    /**
     * Atributos asignables
     */
    protected $fillable = [
        'date',
        'time',
        'user_id',
        'animal_id',
    ];

    /**
     * Relaciones
     */
    public function veterinarian()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function patient()
    {
        return $this->belongsTo(Animal::class, 'animal_id', 'id');
    }
}
