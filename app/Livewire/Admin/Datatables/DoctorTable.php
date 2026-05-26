<?php

namespace App\Livewire\Admin\Datatables;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class DoctorTable extends DataTableComponent
{
    protected $model = Doctor::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('id', 'desc')
            ->setSearchPlaceholder('Buscar')
            ->setPerPageAccepted([10, 25, 50])
            ->setPerPage(10);
    }

    public function builder(): Builder
    {
        return Doctor::query()->with(['user', 'speciality']);
    }

    public function columns(): array
    {
        return [
            Column::make('Nombre', 'user.name')
                ->sortable()
                ->searchable(),
            Column::make('Email', 'user.email')
                ->sortable()
                ->searchable(),
            Column::make('Especialidad', 'speciality.name')
                ->sortable()
                ->searchable(),
            Column::make('Licencia', 'medical_license_number')
                ->sortable()
                ->searchable(),
            Column::make('Teléfono', 'user.phone')
                ->sortable()
                ->searchable(),
            Column::make('Acciones', 'id')
                ->view('admin.doctors.actions')
                ->html()
                ->excludeFromColumnSelect(),
        ];
    }
}
