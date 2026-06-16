<x-admin-layout title="Consulta médica" :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Citas', 'href' => route('admin.appointments.index')],
    ['name' => 'Consulta médica'],
]">
    @livewire('admin.consultation-manager', ['appointment' => $appointment])
</x-admin-layout>
