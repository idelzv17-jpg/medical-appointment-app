<x-admin-layout title="Citas" :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Citas', 'href' => route('admin.appointments.index')],
    ['name' => 'Nueva cita'],
]">
    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        <form action="{{ route('admin.appointments.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label for="patient_id" class="mb-2 block text-sm font-medium text-gray-700">Paciente</label>
                    <select name="patient_id" id="patient_id" required
                        class="block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('patient_id') border-red-500 @enderror">
                        <option value="">Seleccione un paciente</option>
                        @foreach ($patients as $patient)
                            <option value="{{ $patient->id }}" @selected(old('patient_id') == $patient->id)>
                                {{ $patient->user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('patient_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="doctor_id" class="mb-2 block text-sm font-medium text-gray-700">Doctor</label>
                    <select name="doctor_id" id="doctor_id" required
                        class="block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('doctor_id') border-red-500 @enderror">
                        <option value="">Seleccione un doctor</option>
                        @foreach ($doctors as $doctor)
                            <option value="{{ $doctor->id }}" @selected(old('doctor_id') == $doctor->id)>
                                {{ $doctor->user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('doctor_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="date" class="mb-2 block text-sm font-medium text-gray-700">Fecha</label>
                    <input type="date" name="date" id="date" value="{{ old('date') }}" required
                        min="{{ now()->format('Y-m-d') }}"
                        class="block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('date') border-red-500 @enderror">
                    @error('date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="duration" class="mb-2 block text-sm font-medium text-gray-700">Duración (minutos)</label>
                    <input type="number" name="duration" id="duration" value="{{ old('duration', 15) }}" min="1"
                        class="block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('duration') border-red-500 @enderror">
                    @error('duration')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="start_time" class="mb-2 block text-sm font-medium text-gray-700">Hora de inicio</label>
                    <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}" required
                        class="block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('start_time') border-red-500 @enderror">
                    @error('start_time')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="end_time" class="mb-2 block text-sm font-medium text-gray-700">Hora de fin</label>
                    <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}" required
                        class="block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('end_time') border-red-500 @enderror">
                    @error('end_time')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="reason" class="mb-2 block text-sm font-medium text-gray-700">Motivo de la consulta</label>
                    <textarea name="reason" id="reason" rows="4" required
                        placeholder="Describa el motivo de la cita"
                        class="block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('reason') border-red-500 @enderror">{{ old('reason') }}</textarea>
                    @error('reason')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.appointments.index') }}"
                    class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Cancelar
                </a>
                <button type="submit"
                    class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                    <i class="fa-solid fa-check mr-2"></i>
                    Guardar cita
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
