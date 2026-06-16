<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AppointmentController extends Controller
{
    public function index()
    {
        return view('admin.appointments.index');
    }

    public function create()
    {
        $patients = Patient::with('user')->get()->sortBy('user.name');
        $doctors = Doctor::with('user')->get()->sortBy('user.name');

        return view('admin.appointments.create', compact('patients', 'doctors'));
    }

    public function store(Request $request)
    {
        app()->setLocale('es');

        $data = $request->validate([
            'patient_id' => ['required', 'exists:patients,id'],
            'doctor_id' => ['required', 'exists:doctors,id'],
            'date' => ['required', 'date', 'after_or_equal:today'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'duration' => ['nullable', 'integer', 'min:1'],
            'reason' => ['required', 'string'],
        ], [], [
            'patient_id' => 'paciente',
            'doctor_id' => 'doctor',
            'date' => 'fecha',
            'start_time' => 'hora de inicio',
            'end_time' => 'hora de fin',
            'duration' => 'duración',
            'reason' => 'motivo',
        ]);

        $data['duration'] = $data['duration'] ?? 15;
        $data['status'] = Appointment::STATUS_SCHEDULED;

        Appointment::create($data);

        return redirect()
            ->route('admin.appointments.index')
            ->with('success', 'Cita registrada correctamente.');
    }

    public function show(Appointment $appointment)
    {
        $appointment->load(['patient.user', 'doctor.user']);

        return view('admin.appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $patients = Patient::with('user')->get()->sortBy('user.name');
        $doctors = Doctor::with('user')->get()->sortBy('user.name');
        $appointment->load(['patient.user', 'doctor.user']);

        return view('admin.appointments.edit', compact('appointment', 'patients', 'doctors'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        app()->setLocale('es');

        $data = $request->validate([
            'patient_id' => ['required', 'exists:patients,id'],
            'doctor_id' => ['required', 'exists:doctors,id'],
            'date' => ['required', 'date', 'after_or_equal:today'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'duration' => ['nullable', 'integer', 'min:1'],
            'reason' => ['required', 'string'],
            'status' => ['required', Rule::in([
                Appointment::STATUS_SCHEDULED,
                Appointment::STATUS_COMPLETED,
                Appointment::STATUS_CANCELLED,
            ])],
        ], [], [
            'patient_id' => 'paciente',
            'doctor_id' => 'doctor',
            'date' => 'fecha',
            'start_time' => 'hora de inicio',
            'end_time' => 'hora de fin',
            'duration' => 'duración',
            'reason' => 'motivo',
            'status' => 'estatus',
        ]);

        $data['duration'] = $data['duration'] ?? 15;

        $appointment->update($data);

        return redirect()
            ->route('admin.appointments.index')
            ->with('success', 'Cita actualizada correctamente.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()
            ->route('admin.appointments.index')
            ->with('success', 'Cita eliminada correctamente.');
    }

    public function consultation(Appointment $appointment)
    {
        $appointment->load(['patient.user', 'doctor.user', 'consultation.prescriptionItems']);

        return view('admin.appointments.consultation', compact('appointment'));
    }

    public function calendar()
    {
        return view('admin.appointments.calendar');
    }
}
