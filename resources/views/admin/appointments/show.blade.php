<x-admin-layout title="Citas" :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Citas', 'href' => route('admin.appointments.index')],
    ['name' => 'Detalle'],
]">
    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        <dl class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div><dt class="text-sm text-gray-500">Paciente</dt><dd class="font-semibold">{{ $appointment->patient->user->name }}</dd></div>
            <div><dt class="text-sm text-gray-500">Doctor</dt><dd class="font-semibold">{{ $appointment->doctor->user->name }}</dd></div>
            <div><dt class="text-sm text-gray-500">Fecha</dt><dd class="font-semibold">{{ $appointment->date->format('d/m/Y') }}</dd></div>
            <div><dt class="text-sm text-gray-500">Horario</dt><dd class="font-semibold">{{ substr($appointment->start_time, 0, 5) }} - {{ substr($appointment->end_time, 0, 5) }}</dd></div>
            <div><dt class="text-sm text-gray-500">Estatus</dt><dd class="font-semibold">{{ $appointment->status_label }}</dd></div>
            <div class="md:col-span-2"><dt class="text-sm text-gray-500">Motivo</dt><dd>{{ $appointment->reason }}</dd></div>
        </dl>
        <div class="mt-6 flex gap-3">
            <a href="{{ route('admin.appointments.edit', $appointment) }}" class="rounded-md bg-blue-600 px-4 py-2 text-sm text-white">Editar</a>
            <a href="{{ route('admin.appointments.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm text-gray-700">Volver</a>
        </div>
    </div>
</x-admin-layout>
