<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use App\Models\Doctor;
use Carbon\Carbon;
use Livewire\Component;

class AppointmentCalendar extends Component
{
    public int $month;

    public int $year;

    public ?int $doctorId = null;

    public function mount(?int $doctor = null): void
    {
        $now = now();
        $this->month = (int) $now->month;
        $this->year = (int) $now->year;
        $this->doctorId = $doctor;
    }

    public function previousMonth(): void
    {
        $date = Carbon::create($this->year, $this->month, 1)->subMonth();
        $this->month = $date->month;
        $this->year = $date->year;
    }

    public function nextMonth(): void
    {
        $date = Carbon::create($this->year, $this->month, 1)->addMonth();
        $this->month = $date->month;
        $this->year = $date->year;
    }

    public function goToToday(): void
    {
        $this->month = (int) now()->month;
        $this->year = (int) now()->year;
    }

    public function updatedDoctorId($value): void
    {
        $this->doctorId = $value ? (int) $value : null;
    }

    public function getCalendarDaysProperty(): array
    {
        $start = Carbon::create($this->year, $this->month, 1)->startOfMonth()->startOfWeek(Carbon::MONDAY);
        $end = Carbon::create($this->year, $this->month, 1)->endOfMonth()->endOfWeek(Carbon::SUNDAY);

        $days = [];
        $current = $start->copy();

        while ($current->lte($end)) {
            $days[] = $current->copy();
            $current->addDay();
        }

        return $days;
    }

    public function getAppointmentsByDateProperty()
    {
        $start = Carbon::create($this->year, $this->month, 1)->startOfMonth();
        $end = Carbon::create($this->year, $this->month, 1)->endOfMonth();

        $query = Appointment::query()
            ->with(['patient.user', 'doctor.user'])
            ->whereBetween('date', [$start->toDateString(), $end->toDateString()])
            ->orderBy('start_time');

        if ($this->doctorId) {
            $query->where('doctor_id', $this->doctorId);
        }

        return $query->get()->groupBy(fn ($appointment) => $appointment->date->format('Y-m-d'));
    }

    public function render()
    {
        $monthName = Carbon::create($this->year, $this->month, 1)
            ->locale('es')
            ->translatedFormat('F Y');

        return view('livewire.admin.appointment-calendar', [
            'monthName' => ucfirst($monthName),
            'doctors' => Doctor::with('user')->get()->sortBy('user.name'),
        ]);
    }
}
