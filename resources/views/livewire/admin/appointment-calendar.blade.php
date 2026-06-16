<div>
    <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
        <div class="flex items-center gap-2">
            <button type="button" wire:click="previousMonth"
                class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button type="button" wire:click="goToToday"
                class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                Hoy
            </button>
            <button type="button" wire:click="nextMonth"
                class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
            <h2 class="ml-2 text-xl font-bold text-gray-900">{{ $monthName }}</h2>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <select wire:model.live="doctorId"
                class="rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-700 focus:border-blue-500 focus:ring-blue-500">
                <option value="">Todos los doctores</option>
                @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->user->name }}</option>
                @endforeach
            </select>
            <a href="{{ route('admin.appointments.create') }}"
                class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                <i class="fa-solid fa-plus mr-2"></i>
                Nueva cita
            </a>
        </div>
    </div>

    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
        <div class="grid grid-cols-7 border-b border-gray-200 bg-gray-50">
            @foreach (['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'] as $dayName)
                <div class="px-2 py-3 text-center text-xs font-semibold uppercase tracking-wide text-gray-500">
                    {{ $dayName }}
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-7">
            @foreach ($this->calendarDays as $day)
                @php
                    $dateKey = $day->format('Y-m-d');
                    $isCurrentMonth = $day->month === $month;
                    $isToday = $day->isToday();
                    $dayAppointments = $this->appointmentsByDate->get($dateKey, collect());
                @endphp
                <div class="min-h-[120px] border-b border-r border-gray-100 p-2 {{ $isCurrentMonth ? 'bg-white' : 'bg-gray-50' }}">
                    <div class="mb-2 flex items-center justify-between">
                        <span class="inline-flex h-7 w-7 items-center justify-center rounded-full text-sm font-medium
                            {{ $isToday ? 'bg-blue-600 text-white' : ($isCurrentMonth ? 'text-gray-900' : 'text-gray-400') }}">
                            {{ $day->day }}
                        </span>
                        @if ($dayAppointments->count() > 0)
                            <span class="text-xs text-gray-400">{{ $dayAppointments->count() }}</span>
                        @endif
                    </div>

                    <div class="space-y-1">
                        @foreach ($dayAppointments->take(3) as $appointment)
                            @php
                                $statusColor = match ($appointment->status) {
                                    \App\Models\Appointment::STATUS_COMPLETED => 'bg-green-100 text-green-800 border-green-200',
                                    \App\Models\Appointment::STATUS_CANCELLED => 'bg-red-100 text-red-800 border-red-200',
                                    default => 'bg-blue-100 text-blue-800 border-blue-200',
                                };
                            @endphp
                            <a href="{{ route('admin.appointments.consultation', $appointment) }}"
                                title="{{ $appointment->patient->user->name }} con Dr. {{ $appointment->doctor->user->name }}"
                                class="block truncate rounded border px-1.5 py-0.5 text-xs font-medium {{ $statusColor }} hover:opacity-80">
                                {{ substr($appointment->start_time, 0, 5) }}
                                {{ $appointment->patient->user->name }}
                            </a>
                        @endforeach
                        @if ($dayAppointments->count() > 3)
                            <p class="text-xs text-gray-400">+{{ $dayAppointments->count() - 3 }} más</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-4 flex flex-wrap gap-4 text-sm text-gray-600">
        <span class="inline-flex items-center gap-2">
            <span class="h-3 w-3 rounded bg-blue-200"></span> Programada
        </span>
        <span class="inline-flex items-center gap-2">
            <span class="h-3 w-3 rounded bg-green-200"></span> Completada
        </span>
        <span class="inline-flex items-center gap-2">
            <span class="h-3 w-3 rounded bg-red-200"></span> Cancelada
        </span>
    </div>
</div>
