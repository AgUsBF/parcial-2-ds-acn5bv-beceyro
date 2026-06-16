<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Animal;

class AnimalTable extends DataTableComponent
{
    protected $model = Animal::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),

            Column::make("Nombre", "name")
                ->sortable()
                ->searchable(),

            Column::make("Nacimiento", "birth_date")
                ->sortable(),

            Column::make("Sexo", "sex")
                ->sortable(),

            Column::make("Castrado", "is_sterilized")
                ->sortable(),

            Column::make("Especie", "specie.name")
                ->sortable(),

            Column::make("Propietario", "user.name")
                ->sortable(),

            Column::make("Creación", "created_at")
                ->sortable(),

            Column::make("Edición", "updated_at")
                ->sortable(),
        ];
    }
}
