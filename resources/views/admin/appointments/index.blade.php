<x-admin-layout title="Citas" :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Citas'],
]">
    <x-slot name="actions">
        <a href="{{ route('admin.appointments.calendar') }}"
            class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
            <i class="fa-solid fa-calendar-days mr-2"></i>
            Calendario
        </a>
        <x-button primary href="{{ route('admin.appointments.create') }}">
            <i class="fa-solid fa-plus"></i>
            Nueva cita
        </x-button>
    </x-slot>

    @if (session('success'))
        <div class="mb-4 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @livewire('admin.datatables.appointment-table')
</x-admin-layout>
