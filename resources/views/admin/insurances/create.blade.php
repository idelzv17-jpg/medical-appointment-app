<x-admin-layout title="Seguros" :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Seguros', 'href' => route('admin.insurances.index')],
    ['name' => 'Nuevo convenio'],
]">
    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        <x-validation-errors class="mb-4" />

        <form action="{{ route('admin.insurances.store') }}" method="POST" class="space-y-6">
            @csrf
            @include('admin.insurances.partials.form')

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.insurances.index') }}"
                    class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                    Cancelar
                </a>
                <x-button type="submit" primary>
                    Guardar convenio
                </x-button>
            </div>
        </form>
    </div>
</x-admin-layout>
