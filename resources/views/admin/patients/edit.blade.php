<x-admin-layout title="Pacientes" :breadcrumbs="[
    ['name' => 'Dashboard', 'route' => route('admin.dashboard')],
    ['name' => 'Pacientes', 'route' => route('admin.patients.index')],
    ['name' => 'Editar']
]">

    <form action="{{ route('admin.patients.update', $patient) }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        @if (session('success'))
            <div class="mb-4 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800">
                {{ session('success') }}
            </div>
        @endif

        {{-- Encabezado con foto y acciones --}}
        <x-card class="mb-8">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <img src="{{ $patient->user->profile_photo_url }}" alt="{{ $patient->user->name }}" class="w-12 h-12 rounded-full object-cover">
                    <div class="ml-4">
                        <p class="text-2xl font-bold text-gray-900">{{ $patient->user->name }}</p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <x-button outline gray href="{{ route('admin.patients.index') }}">Volver</x-button>
                    <x-button type="submit" primary>
                        <i class="fa-solid fa-check mr-2"></i> Guardar cambios
                    </x-button>
                </div>
            </div>
        </x-card>

        @php
            $patientTabFields = [
                'antecedentes' => ['allergies', 'chronic_conditions', 'surgical_history', 'family_history'],
                'informacion-general' => ['blood_type_id', 'observations'],
                'contacto-emergencia' => ['emergency_contact_name', 'emergency_contact_phone', 'emergency_contact_relationship'],
            ];
            $patientInitialTab = collect($patientTabFields)->search(
                fn ($fields) => $errors->hasAny($fields)
            ) ?: 'datos-personales';
        @endphp

        {{-- Tabs de navegación --}}
        <x-card>
            <div x-data="{ tab: @js($patientInitialTab) }">
                <div class="border-b border-gray-200 mb-4">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                        <li class="relative me-2">
                            @include('admin.patients.partials.tab-link', [
                                'tabId' => 'datos-personales',
                                'icon' => 'fa-user',
                                'label' => 'Datos personales',
                                'hasError' => false,
                            ])
                        </li>
                        <li class="relative me-2">
                            @include('admin.patients.partials.tab-link', [
                                'tabId' => 'antecedentes',
                                'icon' => 'fa-file-lines',
                                'label' => 'Antecedentes',
                                'hasError' => $errors->hasAny($patientTabFields['antecedentes']),
                            ])
                        </li>
                        <li class="relative me-2">
                            @include('admin.patients.partials.tab-link', [
                                'tabId' => 'informacion-general',
                                'icon' => 'fa-info',
                                'label' => 'Información general',
                                'hasError' => $errors->hasAny($patientTabFields['informacion-general']),
                            ])
                        </li>
                        <li class="relative me-2">
                            @include('admin.patients.partials.tab-link', [
                                'tabId' => 'contacto-emergencia',
                                'icon' => 'fa-heart',
                                'label' => 'Contacto de emergencia',
                                'hasError' => $errors->hasAny($patientTabFields['contacto-emergencia']),
                            ])
                        </li>
                    </ul>
                </div>

                {{-- Contenido de las tabs --}}
                <div class="px-4 mt-4">
                    <div x-show="tab === 'datos-personales'">
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6 rounded-r-lg shadow-sm">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                <div class="flex items-start">
                                    <i class="fa-solid fa-user-gear text-blue-500 text-xl mt-1 mr-3"></i>
                                    <div>
                                        <h3 class="text-sm font-bold text-blue-800">Edición de cuenta de usuario</h3>
                                        <p class="text-sm text-blue-600">La <strong>información de acceso</strong> (Nombre, email) debe gestionarse desde la cuenta de usuarios asociada.</p>
                                    </div>
                                </div>
                                <div class="mt-4 sm:mt-0">
                                    <x-button primary sm href="{{ route('admin.users.edit', $patient->user) }}" target="_blank">
                                        Editar usuario <i class="fa-solid fa-arrow-up-right-from-square ms-2"></i>
                                    </x-button>
                                </div>
                            </div>
                        </div>
                        <div class ="grid lg:grid-cols-2 gap-4">
                                    <div>
                                        <span class="text-gray-500 font-semibold">
                                            Teléfono:
                                        </span>
                                        <span class="text-gray-900 text-sm ml-1">
                                            {{ $patient->user->phone ?? 'No registrado' }}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500 font-semibold">
                                            Email:
                                        </span>
                                        <span class="text-gray-900 text-sm ml-1">
                                            {{ $patient->user->email ?? 'No registrado' }}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500 font-semibold">
                                            Dirección:
                                        </span>
                                        <span class="text-gray-900 text-sm ml-1">
                                            {{ $patient->user->address ?? 'No registrado' }}
                                        </span>
                                    </div>
                                </div>
                    </div>

                    <div x-show="tab === 'antecedentes'">
                        @includeIf('admin.patients.partials.edit-antecedentes')
                    </div>

                    <div x-show="tab === 'informacion-general'">
                        @includeIf('admin.patients.partials.edit-informacion-general')
                    </div>

                    <div x-show="tab === 'contacto-emergencia'">
                        @if(View::exists('admin.patients.partials.edit-contacto-emergencia'))
                            @includeIf('admin.patients.partials.edit-contacto-emergencia')
                        @else
                            <p class="text-gray-500 italic">El formulario de contacto de emergencia aún no ha sido creado.</p>
                        @endif
                    </div>
                </div>
            </div>
        </x-card>
    </form>
</x-admin-layout>