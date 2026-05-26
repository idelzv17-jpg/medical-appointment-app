<x-admin-layout title="Doctores" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Doctores',
        'href' => route('admin.doctors.index'),
    ],
    [
        'name' => 'Detalle',
    ],
]">
    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm space-y-4">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-semibold text-gray-900">{{ $doctor->name }}</h2>
                <p class="text-sm text-gray-500">ID: {{ $doctor->id }}</p>
            </div>
            <x-button outline secondary href="{{ route('admin.doctors.index') }}">Volver</x-button>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div class="rounded-lg border border-gray-100 bg-gray-50 p-4">
                <p class="text-sm font-medium text-gray-700">Creado</p>
                <p class="mt-1 text-sm text-gray-900">{{ $doctor->created_at?->format('d/m/Y H:i') ?? '-' }}</p>
            </div>
            <div class="rounded-lg border border-gray-100 bg-gray-50 p-4">
                <p class="text-sm font-medium text-gray-700">Última actualización</p>
                <p class="mt-1 text-sm text-gray-900">{{ $doctor->updated_at?->format('d/m/Y H:i') ?? '-' }}</p>
            </div>
        </div>
    </div>
</x-admin-layout>
