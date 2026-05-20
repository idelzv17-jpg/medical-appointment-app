<x-admin-layout title="Roles" :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Roles', 'href' => route('admin.roles.index')],
    ['name' => 'Editar'],
]">
    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        <x-validation-errors class="mb-4" />

        <form action="{{ route('admin.roles.update', $role) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700">Nombre</label>
                <input name="name" value="{{ old('name', $role->name) }}" placeholder="Nombre del rol"
                    class="block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                    required>
                <x-input-error for="name" class="mt-2" />
            </div>

            <div class="flex flex-wrap items-center justify-end gap-3 border-t border-gray-100 pt-4">
                <x-button outline secondary href="{{ route('admin.roles.index') }}">
                    Cancelar
                </x-button>
                <x-button type="submit" primary>
                    <i class="fa-solid fa-check"></i>
                    Guardar
                </x-button>
            </div>
        </form>
    </div>
</x-admin-layout>
