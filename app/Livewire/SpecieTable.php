<?php

namespace App\Livewire;

use App\Models\Specie;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class SpecieTable extends DataTableComponent
{
    protected $model = Specie::class;

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

            Column::make("Creación", "created_at")
                ->sortable(),

            Column::make("Edición", "updated_at")
                ->sortable(),
            
            Column::make('Acciones')
                ->label(fn ($row, Column $column) => view('species.actions', ['row' => $row]))
                ->html(),
        ];
    }
}
