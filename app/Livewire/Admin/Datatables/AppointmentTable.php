<?php

namespace App\Livewire\Admin\Datatables;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class AppointmentTable extends DataTableComponent
{
    protected $model = Appointment::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('date', 'desc')
            ->setSearchPlaceholder('Buscar')
            ->setPerPageAccepted([10, 25, 50])
            ->setPerPage(10);
    }

    public function builder(): Builder
    {
        return Appointment::query()->with(['patient.user', 'doctor.user']);
    }

    public function columns(): array
    {
        return [
            Column::make('Paciente', 'patient.user.name')
                ->sortable()
                ->searchable(),
            Column::make('Doctor', 'doctor.user.name')
                ->sortable()
                ->searchable(),
            Column::make('Fecha', 'date')
                ->sortable()
                ->format(fn ($value) => $value?->format('d/m/Y')),
            Column::make('Hora inicio', 'start_time')
                ->sortable()
                ->format(fn ($value) => $value ? substr($value, 0, 5) : '-'),
            Column::make('Estatus', 'status')
                ->format(fn ($value) => Appointment::statusLabels()[$value] ?? 'Desconocido'),
            Column::make('Acciones', 'id')
                ->view('admin.appointments.actions')
                ->html()
                ->excludeFromColumnSelect(),
        ];
    }
}
