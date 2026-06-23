<?php

namespace App\Livewire;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class VetTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('name', 'asc');
    }

    public function builder(): Builder
    {
        $query = User::query()->with($this->getRelationships());
        $query->where('role_id', Role::VET_ID); // Filtrar solo usuarios con role_id = 2 (veterinarios)

        return $query;
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->sortable(),

            Column::make('Nombre', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),
        ];
    }
}
