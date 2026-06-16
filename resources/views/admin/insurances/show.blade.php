<x-admin-layout title="Seguros" :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Seguros', 'href' => route('admin.insurances.index')],
    ['name' => $insurance->name],
]">
    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">{{ $insurance->name }}</h2>
                <p class="text-sm text-gray-500">{{ $insurance->insurer_name }}</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.insurances.edit', $insurance) }}"
                    class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm text-white hover:bg-blue-700">
                    Editar
                </a>
                <a href="{{ route('admin.insurances.index') }}"
                    class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                    Volver
                </a>
            </div>
        </div>

        <dl class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div>
                <dt class="text-sm text-gray-500">Código del convenio</dt>
                <dd class="font-semibold text-gray-900">{{ $insurance->agreement_code }}</dd>
            </div>
            <div>
                <dt class="text-sm text-gray-500">Estado</dt>
                <dd class="font-semibold text-gray-900">{{ $insurance->status_label }}</dd>
            </div>
            <div>
                <dt class="text-sm text-gray-500">Porcentaje de cobertura</dt>
                <dd class="font-semibold text-gray-900">{{ $insurance->coverage_percentage ? $insurance->coverage_percentage . '%' : '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm text-gray-500">Teléfono</dt>
                <dd class="font-semibold text-gray-900">{{ $insurance->contact_phone ?? '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm text-gray-500">Correo</dt>
                <dd class="font-semibold text-gray-900">{{ $insurance->contact_email ?? '—' }}</dd>
            </div>
            <div class="md:col-span-2">
                <dt class="text-sm text-gray-500">Descripción de cobertura</dt>
                <dd class="text-gray-900">{{ $insurance->coverage_description ?? '—' }}</dd>
            </div>
            <div class="md:col-span-2">
                <dt class="text-sm text-gray-500">Notas</dt>
                <dd class="text-gray-900">{{ $insurance->notes ?? '—' }}</dd>
            </div>
        </dl>
    </div>
</x-admin-layout>
