<x-admin-layout title="Seguros" :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Seguros'],
]">
    <x-slot name="actions">
        <x-button primary href="{{ route('admin.insurances.create') }}">
            <i class="fa-solid fa-plus"></i>
            Nuevo convenio
        </x-button>
    </x-slot>

    @if (session('success'))
        <div class="mb-4 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="border-b text-gray-600">
                    <tr>
                        <th class="py-3 pr-4">Convenio</th>
                        <th class="py-3 pr-4">Aseguradora</th>
                        <th class="py-3 pr-4">Código</th>
                        <th class="py-3 pr-4">Cobertura</th>
                        <th class="py-3 pr-4">Contacto</th>
                        <th class="py-3 pr-4">Estado</th>
                        <th class="py-3 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($insurances as $insurance)
                        <tr class="border-b">
                            <td class="py-3 pr-4 font-medium text-gray-900">{{ $insurance->name }}</td>
                            <td class="py-3 pr-4">{{ $insurance->insurer_name }}</td>
                            <td class="py-3 pr-4">{{ $insurance->agreement_code }}</td>
                            <td class="py-3 pr-4">
                                {{ $insurance->coverage_percentage ? $insurance->coverage_percentage . '%' : '—' }}
                            </td>
                            <td class="py-3 pr-4">
                                <div>{{ $insurance->contact_phone ?? '—' }}</div>
                                <div class="text-xs text-gray-500">{{ $insurance->contact_email ?? '' }}</div>
                            </td>
                            <td class="py-3 pr-4">
                                @if ($insurance->is_active)
                                    <span class="inline-flex rounded-full bg-green-100 px-2 py-1 text-xs font-semibold text-green-700">Activo</span>
                                @else
                                    <span class="inline-flex rounded-full bg-gray-100 px-2 py-1 text-xs font-semibold text-gray-600">Inactivo</span>
                                @endif
                            </td>
                            <td class="py-3">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.insurances.show', $insurance) }}"
                                        class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 hover:bg-gray-50"
                                        title="Ver">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.insurances.edit', $insurance) }}"
                                        class="inline-flex items-center rounded-lg bg-primary-600 px-3 py-2 text-sm font-medium text-white hover:bg-primary-700"
                                        title="Editar">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('admin.insurances.destroy', $insurance) }}" method="POST" class="inline-block"
                                        onsubmit="return confirm('¿Eliminar este convenio de seguro?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center rounded-lg bg-red-600 px-3 py-2 text-sm font-medium text-white hover:bg-red-700"
                                            title="Eliminar">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-gray-500">
                                No hay convenios de seguro registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
