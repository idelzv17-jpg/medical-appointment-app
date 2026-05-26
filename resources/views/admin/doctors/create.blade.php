<x-admin-layout title="Doctores" :breadcrumbs="[
    [
        "name" => "Dashboard",
        "href" => route("admin.dashboard"),
    ],
    [
        "name" => "Doctores",
        "href" => route("admin.doctors.index"),
    ],
    [
        "name" => "Nuevo",
    ],
]">
    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        <x-validation-errors class="mb-4" />

        <form action="{{ route("admin.doctors.store") }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700">Nombre</label>
                <input name="name" value="{{ old("name") }}" placeholder="Nombre del doctor"
                    class="block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                    required>
                <x-input-error for="name" class="mt-2" />
            </div>

            <div class="flex justify-end">
                <x-button type="submit" primary>
                    Guardar
                </x-button>
            </div>
        </form>
    </div>
</x-admin-layout>
