<?php

namespace App\Livewire\Admin\Datatables;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PatientTable extends DataTableComponent
{
    protected $model = Patient::class;

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
        return Patient::query()->with('user');
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
            Column::make('Número de ID', 'user.id_number')
                ->sortable()
                ->searchable(),
            Column::make('Teléfono', 'user.phone')
                ->sortable()
                ->searchable(),
            Column::make('Acciones', 'id')
                ->view('admin.patients.actions')
                ->html()
                ->excludeFromColumnSelect(),
        ];
    }
}
