<?php

namespace App\Livewire;

use App\Models\Animal;
use Illuminate\Support\Carbon;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class AnimalTable extends DataTableComponent
{
    protected $model = Animal::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'asc');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->sortable(),

            Column::make('Nombre', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Nacimiento', 'birth_date')
                ->sortable()
                ->format(fn ($value) => $value ? Carbon::parse($value)->format('d/m/Y') : '-'),

            Column::make('Sexo', 'sex')
                ->sortable(),

            Column::make('Castrado', 'is_sterilized')
                ->sortable()
                ->format(fn ($value) => $value ? 'Sí' : 'No'),

            Column::make('Especie', 'specie.name')
                ->sortable(),

            Column::make('Propietario', 'user.name')
                ->sortable(),

            Column::make('Creación', 'created_at')
                ->sortable()
                ->deselected(),

            Column::make('Edición', 'updated_at')
                ->sortable()
                ->deselected(),

            Column::make('Acciones')
                ->label(fn ($row, Column $column) => view('animals.actions', ['row' => $row]))
                ->html(),
        ];
    }
}
