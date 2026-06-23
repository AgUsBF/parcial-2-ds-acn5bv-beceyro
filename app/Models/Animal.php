<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'specie_id',
        'user_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'is_sterilized' => 'boolean',
        ];
    }

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
