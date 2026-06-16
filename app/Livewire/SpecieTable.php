<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Specie;

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
        ];
    }
}
