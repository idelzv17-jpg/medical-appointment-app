<?php

namespace App\Livewire\Admin\Datatables;

use App\Models\User;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
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
            Column::make('Identificación', 'id_number')
                ->sortable()
                ->searchable(),
            Column::make('Teléfono', 'phone')
                ->sortable(),
            Column::make('Dirección', 'address')
                ->sortable(),
            Column::make('Creado', 'created_at')
                ->sortable(),
            Column::make('Actualizado', 'updated_at')
                ->sortable(),
        ];
    }
}
