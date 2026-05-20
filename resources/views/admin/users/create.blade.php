<x-admin-layout title="Usuarios" :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Usuarios', 'href' => route('admin.users.index')],
    ['name' => 'Crear'],
]">
    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        <x-validation-errors class="mb-4" />

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">Nombre</label>
                    <input name="name" value="{{ old('name') }}" placeholder="Nombre completo"
                        class="block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                        required>
                    <x-input-error for="name" class="mt-2" />
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">Correo electrónico</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="ejemplo@dominio.com"
                        autocomplete="email"
                        class="block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                        required>
                    <x-input-error for="email" class="mt-2" />
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">Contraseña</label>
                    <input type="password" name="password" placeholder="Mínimo 8 caracteres"
                        autocomplete="new-password"
                        class="block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                        required>
                    <x-input-error for="password" class="mt-2" />
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">Confirmar contraseña</label>
                    <input type="password" name="password_confirmation" placeholder="Repita la contraseña"
                        autocomplete="new-password"
                        class="block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                        required>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">Número de ID</label>
                    <input name="id_number" value="{{ old('id_number') }}" placeholder="Ej. ID-12345" autocomplete="off"
                        class="block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    <x-input-error for="id_number" class="mt-2" />
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">Teléfono</label>
                    <input name="phone" value="{{ old('phone') }}" placeholder="Ej. 999999999" autocomplete="tel"
                        class="block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    <x-input-error for="phone" class="mt-2" />
                </div>

                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-gray-700">Dirección</label>
                    <input name="address" value="{{ old('address') }}" placeholder="Ej. Calle 123, Col. Centro"
                        autocomplete="street-address"
                        class="block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    <x-input-error for="address" class="mt-2" />
                </div>

                <div class="space-y-1">
                    <x-native-select name="role_id" label="Rol" required>
                        <option value="">
                            Seleccione un rol
                        </option>

                        @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                        @endforeach
                    </x-native-select>
                    <p class="text-sm text-gray-500">
                        Define lo permisos y accesos del Usuarios.
                    </p>
                </div>

                <div class="flex justify-end md:col-span-2">
                    <x-button type="submit" primary>Guardar</x-button>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>

