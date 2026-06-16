<div>
    {{-- Encabezado --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Consulta médica</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Paciente: <span class="font-semibold text-gray-800">{{ $appointment->patient->user->name }}</span>
                    &middot; Doctor: <span class="font-semibold text-gray-800">{{ $appointment->doctor->user->name }}</span>
                    &middot; Fecha: {{ $appointment->date->format('d/m/Y') }}
                    {{ substr($appointment->start_time, 0, 5) }} - {{ substr($appointment->end_time, 0, 5) }}
                </p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.patients.edit', ['patient' => $appointment->patient, 'tab' => 'personal']) }}"
                    class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    <i class="fa-solid fa-file-medical mr-2"></i>
                    Ver / Editar Historia médica
                </a>
                <button type="button" wire:click="openHistoryModal"
                    class="inline-flex items-center rounded-md border border-blue-300 bg-blue-50 px-4 py-2 text-sm font-medium text-blue-700 hover:bg-blue-100">
                    <i class="fa-solid fa-clock-rotate-left mr-2"></i>
                    Consultas anteriores
                </button>
                <a href="{{ route('admin.appointments.index') }}"
                    class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Volver
                </a>
            </div>
        </div>
    </div>

    @php
        $hasErrorsConsulta = $errors->hasAny(['diagnosis', 'treatment', 'notes']);
        $hasErrorsReceta = $errors->has('medications') || collect($errors->keys())->contains(fn ($k) => str_starts_with($k, 'medications.'));
        $activeTab = $errors->any()
            ? ($hasErrorsConsulta ? 'consulta' : ($hasErrorsReceta ? 'receta' : 'consulta'))
            : 'consulta';
    @endphp

    <form wire:submit="save">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <x-tab-container defaultTab="consulta" :errorTab="$errors->any() ? $activeTab : ''">
                <div class="border-b border-gray-200 mb-6">
                    <nav class="flex space-x-8" aria-label="Tabs">
                        <x-tab-button name="consulta" icon="fa-solid fa-stethoscope" :hasErrors="$hasErrorsConsulta" :active="$activeTab === 'consulta'">
                            Consulta
                        </x-tab-button>
                        <x-tab-button name="receta" icon="fa-solid fa-pills" :hasErrors="$hasErrorsReceta" :active="$activeTab === 'receta'">
                            Receta
                        </x-tab-button>
                    </nav>
                </div>

                {{-- Pestaña Consulta --}}
                <x-tab-panel name="consulta" :active="$activeTab === 'consulta'">
                    <div class="space-y-4">
                        <div>
                            <label for="diagnosis" class="block text-sm font-medium mb-1 @error('diagnosis') text-red-600 @else text-gray-700 @enderror">Diagnóstico</label>
                            <textarea wire:model="diagnosis" id="diagnosis" rows="4"
                                class="w-full rounded-lg border shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('diagnosis') border-red-500 @else border-gray-300 @enderror"
                                placeholder="Ingrese el diagnóstico"></textarea>
                            @error('diagnosis')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="treatment" class="block text-sm font-medium mb-1 @error('treatment') text-red-600 @else text-gray-700 @enderror">Tratamiento</label>
                            <textarea wire:model="treatment" id="treatment" rows="4"
                                class="w-full rounded-lg border shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('treatment') border-red-500 @else border-gray-300 @enderror"
                                placeholder="Ingrese el tratamiento"></textarea>
                            @error('treatment')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="notes" class="block text-sm font-medium mb-1 text-gray-700">Notas <span class="text-gray-400">(opcional)</span></label>
                            <textarea wire:model="notes" id="notes" rows="3"
                                class="w-full rounded-lg border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Notas adicionales"></textarea>
                            @error('notes')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </x-tab-panel>

                {{-- Pestaña Receta --}}
                <x-tab-panel name="receta" :active="$activeTab === 'receta'">
                    @error('medications')
                        <p class="mb-4 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <div class="space-y-4">
                        @foreach ($medications as $index => $medication)
                            <div class="rounded-lg border border-gray-200 p-4" wire:key="medication-{{ $index }}">
                                <div class="flex items-center justify-between mb-3">
                                    <h4 class="text-sm font-semibold text-gray-800">Medicamento {{ $index + 1 }}</h4>
                                    @if (count($medications) > 1)
                                        <button type="button" wire:click="removeMedication({{ $index }})"
                                            class="text-sm text-red-600 hover:text-red-800">
                                            <i class="fa-solid fa-trash"></i> Eliminar
                                        </button>
                                    @endif
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium mb-1 @error('medications.'.$index.'.medication') text-red-600 @else text-gray-700 @enderror">Medicamento</label>
                                        <input type="text" wire:model="medications.{{ $index }}.medication"
                                            class="w-full rounded-lg border shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('medications.'.$index.'.medication') border-red-500 @else border-gray-300 @enderror"
                                            placeholder="Nombre del medicamento">
                                        @error('medications.'.$index.'.medication')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1 text-gray-700">Dosis</label>
                                        <input type="text" wire:model="medications.{{ $index }}.dosage"
                                            class="w-full rounded-lg border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Ej. 500mg">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1 text-gray-700">Frecuencia</label>
                                        <input type="text" wire:model="medications.{{ $index }}.frequency"
                                            class="w-full rounded-lg border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Ej. Cada 8 horas">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1 text-gray-700">Duración</label>
                                        <input type="text" wire:model="medications.{{ $index }}.duration"
                                            class="w-full rounded-lg border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Ej. 7 días">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1 text-gray-700">Instrucciones</label>
                                        <input type="text" wire:model="medications.{{ $index }}.instructions"
                                            class="w-full rounded-lg border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Ej. Tomar con alimentos">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" wire:click="addMedication"
                        class="mt-4 inline-flex items-center rounded-md border border-dashed border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                        <i class="fa-solid fa-plus mr-2"></i>
                        Agregar medicamento
                    </button>
                </x-tab-panel>
            </x-tab-container>

            <div class="mt-6 flex justify-end">
                <button type="submit"
                    class="inline-flex items-center rounded-md bg-blue-600 px-5 py-2 text-sm font-medium text-white hover:bg-blue-700"
                    wire:loading.attr="disabled">
                    <i class="fa-solid fa-check mr-2"></i>
                    <span wire:loading.remove wire:target="save">Guardar consulta</span>
                    <span wire:loading wire:target="save">Guardando...</span>
                </button>
            </div>
        </div>
    </form>

    {{-- Modal Consultas anteriores --}}
    @if ($showHistoryModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50" wire:click.self="closeHistoryModal">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-[80vh] overflow-hidden">
                <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4">
                    <h3 class="text-lg font-bold text-gray-900">Consultas anteriores</h3>
                    <button type="button" wire:click="closeHistoryModal" class="text-gray-400 hover:text-gray-600">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>
                <div class="px-6 py-4 overflow-y-auto max-h-[60vh]">
                    @forelse ($pastConsultations as $consultation)
                        <div class="mb-4 rounded-lg border border-gray-200 p-4 last:mb-0">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-semibold text-gray-800">
                                    {{ $consultation->appointment?->date?->format('d/m/Y') ?? $consultation->created_at->format('d/m/Y') }}
                                </span>
                                <span class="text-sm text-gray-500">
                                    Dr. {{ $consultation->doctor->user->name }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-700"><span class="font-medium">Diagnóstico:</span> {{ $consultation->diagnosis }}</p>
                            <p class="text-sm text-gray-700 mt-1"><span class="font-medium">Tratamiento:</span> {{ $consultation->treatment }}</p>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-8">No hay consultas anteriores registradas para este paciente.</p>
                    @endforelse
                </div>
                <div class="border-t border-gray-200 px-6 py-4 flex justify-end">
                    <button type="button" wire:click="closeHistoryModal"
                        class="rounded-md bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
