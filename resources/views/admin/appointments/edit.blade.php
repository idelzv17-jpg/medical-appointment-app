<x-admin-layout title="Citas" :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Citas', 'href' => route('admin.appointments.index')],
    ['name' => 'Editar'],
]">
    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        <form action="{{ route('admin.appointments.update', $appointment) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label for="patient_id" class="mb-2 block text-sm font-medium text-gray-700">Paciente</label>
                    <select name="patient_id" id="patient_id" required
                        class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm @error('patient_id') border-red-500 @enderror">
                        @foreach ($patients as $patient)
                            <option value="{{ $patient->id }}" @selected(old('patient_id', $appointment->patient_id) == $patient->id)>
                                {{ $patient->user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('patient_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="doctor_id" class="mb-2 block text-sm font-medium text-gray-700">Doctor</label>
                    <select name="doctor_id" id="doctor_id" required
                        class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm @error('doctor_id') border-red-500 @enderror">
                        @foreach ($doctors as $doctor)
                            <option value="{{ $doctor->id }}" @selected(old('doctor_id', $appointment->doctor_id) == $doctor->id)>
                                {{ $doctor->user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('doctor_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="date" class="mb-2 block text-sm font-medium text-gray-700">Fecha</label>
                    <input type="date" name="date" id="date"
                        value="{{ old('date', $appointment->date->format('Y-m-d')) }}" required
                        min="{{ now()->format('Y-m-d') }}"
                        class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm @error('date') border-red-500 @enderror">
                    @error('date')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="status" class="mb-2 block text-sm font-medium text-gray-700">Estatus</label>
                    <select name="status" id="status" class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
                        @foreach (\App\Models\Appointment::statusLabels() as $value => $label)
                            <option value="{{ $value }}" @selected(old('status', $appointment->status) == $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="start_time" class="mb-2 block text-sm font-medium text-gray-700">Hora de inicio</label>
                    <input type="time" name="start_time" id="start_time"
                        value="{{ old('start_time', substr($appointment->start_time, 0, 5)) }}" required
                        class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm @error('start_time') border-red-500 @enderror">
                    @error('start_time')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="end_time" class="mb-2 block text-sm font-medium text-gray-700">Hora de fin</label>
                    <input type="time" name="end_time" id="end_time"
                        value="{{ old('end_time', substr($appointment->end_time, 0, 5)) }}" required
                        class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm @error('end_time') border-red-500 @enderror">
                    @error('end_time')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="md:col-span-2">
                    <label for="reason" class="mb-2 block text-sm font-medium text-gray-700">Motivo</label>
                    <textarea name="reason" id="reason" rows="4" required
                        class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm @error('reason') border-red-500 @enderror">{{ old('reason', $appointment->reason) }}</textarea>
                    @error('reason')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.appointments.index') }}" class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Cancelar</a>
                <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-sm text-white hover:bg-blue-700">Guardar cambios</button>
            </div>
        </form>
    </div>
</x-admin-layout>
