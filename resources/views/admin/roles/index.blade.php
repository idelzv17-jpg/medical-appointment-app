<x-admin-layout title="Roles" :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Roles'],
]">
    <x-slot name="actions">
        <x-button primary href="{{ route('admin.roles.create') }}">
            <i class="fa-solid fa-plus"></i>
            Crear rol
        </x-button>
    </x-slot>

    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="border-b text-gray-600">
                    <tr>
                        <th class="py-2">Nombre</th>
                        <th class="py-2">Protegido</th>
                        <th class="py-2 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr class="border-b">
                            <td class="py-2">{{ $role->name }}</td>
                            <td class="py-2">
                                @if ($role->is_system)
                                    <span class="text-xs font-semibold text-gray-700">Sí</span>
                                @else
                                    <span class="text-xs text-gray-500">No</span>
                                @endif
                            </td>
                            <td class="py-2">
                                <div class="flex justify-end gap-2">
                                    @if (! $role->is_system)
                                        <x-button primary flat sm href="{{ route('admin.roles.edit', $role) }}">
                                            Editar
                                        </x-button>
                                        <form class="delete-form inline" action="{{ route('admin.roles.destroy', $role) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Eliminar este rol?')">
                                            @csrf
                                            @method('DELETE')
                                            <x-button type="submit" negative flat sm>
                                                Eliminar
                                            </x-button>
                                        </form>
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>

