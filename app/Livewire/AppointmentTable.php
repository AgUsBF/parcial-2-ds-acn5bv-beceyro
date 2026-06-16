<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Appointment;

class AppointmentTable extends DataTableComponent
{
    protected $model = Appointment::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),

            Column::make("Fecha", "date")
                ->sortable()
                ->searchable(),

            Column::make("Horario", "time")
                ->sortable(),

            Column::make("Mascota", "patient.name")
                ->sortable(),

            Column::make("Veterinario", "veterinarian.name")
                ->sortable(),

            Column::make("Creación", "created_at")
                ->sortable(),

            Column::make("Edición", "updated_at")
                ->sortable(),
        ];
    }
}
