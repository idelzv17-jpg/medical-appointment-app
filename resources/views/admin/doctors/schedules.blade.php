<x-admin-layout title="Horarios" :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Doctores', 'href' => route('admin.doctors.index')],
    ['name' => $doctor->user->name],
    ['name' => 'Horarios'],
]">
    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Horarios de {{ $doctor->user->name }}</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Módulo de horarios automáticos en desarrollo. Por ahora la asignación de citas es manual.
                </p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.appointments.calendar', ['doctor' => $doctor->id]) }}"
                    class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                    <i class="fa-solid fa-calendar-days mr-2"></i>
                    Ver calendario de citas
                </a>
                <a href="{{ route('admin.doctors.index') }}"
                    class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Volver
                </a>
            </div>
        </div>

        <div class="rounded-lg border border-dashed border-gray-300 bg-gray-50 p-8 text-center">
            <i class="fa-solid fa-clock text-4xl text-gray-400 mb-4"></i>
            <p class="text-gray-600">Aquí se configurarán los horarios disponibles del doctor.</p>
            <p class="text-sm text-gray-500 mt-2">Especialidad: {{ $doctor->speciality->name ?? 'Sin especialidad' }}</p>
        </div>
    </div>
</x-admin-layout>
