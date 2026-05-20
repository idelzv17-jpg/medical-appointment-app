<x-admin-layout title="Pacientes" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
        
    ],
    [
        'name' => 'Pacientes'
    ],
   

]">
    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.patients.create') }}"
            class="inline-flex items-center gap-2 rounded-lg bg-primary-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
            <i class="fa-solid fa-plus"></i>
            Nuevo paciente
        </a>
    </div>

    @livewire('admin.datatables.patient-table')

</x-admin-layout>