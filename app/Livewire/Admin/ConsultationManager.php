<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use App\Models\Consultation;
use Livewire\Component;

class ConsultationManager extends Component
{
    public Appointment $appointment;

    public string $diagnosis = '';

    public string $treatment = '';

    public ?string $notes = null;

    public array $medications = [];

    public bool $showHistoryModal = false;

    public function mount(Appointment $appointment): void
    {
        $this->appointment = $appointment->load(['patient.user', 'doctor.user', 'consultation.prescriptionItems']);

        if ($this->appointment->consultation) {
            $consultation = $this->appointment->consultation;
            $this->diagnosis = $consultation->diagnosis;
            $this->treatment = $consultation->treatment;
            $this->notes = $consultation->notes;
            $this->medications = $consultation->prescriptionItems->map(fn ($item) => [
                'medication' => $item->medication,
                'dosage' => $item->dosage ?? '',
                'frequency' => $item->frequency ?? '',
                'duration' => $item->duration ?? '',
                'instructions' => $item->instructions ?? '',
            ])->toArray();
        }

        if (empty($this->medications)) {
            $this->addMedication();
            $this->addMedication();
        }
    }

    public function addMedication(): void
    {
        $this->medications[] = [
            'medication' => '',
            'dosage' => '',
            'frequency' => '',
            'duration' => '',
            'instructions' => '',
        ];
    }

    public function removeMedication(int $index): void
    {
        unset($this->medications[$index]);
        $this->medications = array_values($this->medications);
    }

    public function openHistoryModal(): void
    {
        $this->showHistoryModal = true;
    }

    public function closeHistoryModal(): void
    {
        $this->showHistoryModal = false;
    }

    public function save(): void
    {
        app()->setLocale('es');

        $validated = $this->validate([
            'diagnosis' => ['required', 'string'],
            'treatment' => ['required', 'string'],
            'notes' => ['nullable', 'string'],
            'medications' => ['required', 'array', 'min:1'],
            'medications.*.medication' => ['required', 'string'],
            'medications.*.dosage' => ['nullable', 'string'],
            'medications.*.frequency' => ['nullable', 'string'],
            'medications.*.duration' => ['nullable', 'string'],
            'medications.*.instructions' => ['nullable', 'string'],
        ], [], [
            'diagnosis' => 'diagnóstico',
            'treatment' => 'tratamiento',
            'notes' => 'notas',
            'medications' => 'receta',
            'medications.*.medication' => 'medicamento',
        ]);

        $consultation = Consultation::updateOrCreate(
            ['appointment_id' => $this->appointment->id],
            [
                'patient_id' => $this->appointment->patient_id,
                'doctor_id' => $this->appointment->doctor_id,
                'diagnosis' => $validated['diagnosis'],
                'treatment' => $validated['treatment'],
                'notes' => $validated['notes'],
            ]
        );

        $consultation->prescriptionItems()->delete();

        foreach ($validated['medications'] as $item) {
            if (filled($item['medication'])) {
                $consultation->prescriptionItems()->create($item);
            }
        }

        $this->appointment->update(['status' => Appointment::STATUS_COMPLETED]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Consulta guardada',
            'text' => 'La consulta médica se registró correctamente.',
        ]);

        $this->redirect(route('admin.appointments.index'));
    }

    public function getPastConsultationsProperty()
    {
        return Consultation::query()
            ->with(['doctor.user', 'appointment'])
            ->where('patient_id', $this->appointment->patient_id)
            ->where('id', '!=', $this->appointment->consultation?->id)
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.consultation-manager', [
            'pastConsultations' => $this->pastConsultations,
        ]);
    }
}
