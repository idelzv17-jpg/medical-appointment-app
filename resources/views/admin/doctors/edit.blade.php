<x-admin-layout title="Doctores" :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Doctores', 'href' => route('admin.doctors.index')],
    ['name' => 'Editar'],
]">
    <form action="{{ route('admin.doctors.update', $doctor) }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        @if (session('success'))
            <div class="mb-4 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <x-validation-errors class="mb-4" />

        {{-- Encabezado con foto, nombre y acciones --}}
        <x-card class="mb-8">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center">
                    <img src="{{ $doctor->user->profile_photo_url }}"
                         alt="{{ $doctor->user->name }}"
                         class="w-12 h-12 rounded-full object-cover">
                    <div class="ml-4">
                        <p class="text-2xl font-bold text-gray-900">
                            {{ $doctor->user->name }}
                        </p>
                        <p class="text-sm text-gray-500">
                            Licencia: {{ $doctor->medical_license_number ?? 'N/A' }}
                        </p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <x-button outline gray href="{{ route('admin.doctors.index') }}">
                        Volver
                    </x-button>
                    <x-button type="submit" primary>
                        <i class="fa-solid fa-check mr-2"></i>
                        Guardar cambios
                    </x-button>
                </div>
            </div>
        </x-card>

        {{-- Datos profesionales --}}
        <x-card>
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <x-native-select
                        label="Especialidad"
                        name="speciality_id"
                        placeholder="Seleccione una especialidad">
                        @foreach ($specialities as $speciality)
                            <option value="{{ $speciality->id }}"
                                @selected(old('speciality_id', $doctor->speciality_id) == $speciality->id)>
                                {{ $speciality->name }}
                            </option>
                        @endforeach
                    </x-native-select>
                    <x-input-error for="speciality_id" class="mt-2" />
                </div>

                <div>
                    <x-input
                        label="Número de licencia médica"
                        name="medical_license_number"
                        :value="old('medical_license_number', $doctor->medical_license_number)"
                        placeholder="Ej. 6549876341654654" />
                    <x-input-error for="medical_license_number" class="mt-2" />
                </div>

                <div>
                    <x-textarea
                        label="Biografía"
                        name="biography"
                        rows="5"
                        placeholder="Escribe una breve biografía del doctor">{{ old('biography', $doctor->biography) }}</x-textarea>
                    <x-input-error for="biography" class="mt-2" />
                </div>
            </div>
        </x-card>
    </form>
</x-admin-layout>
