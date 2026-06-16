<x-admin-layout title="Calendarios" :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Calendarios'],
]">
    @livewire('admin.appointment-calendar', ['doctor' => request('doctor')])
</x-admin-layout>
