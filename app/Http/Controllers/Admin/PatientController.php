<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\BloodType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        User::role('Paciente')->get()->each->syncRoleProfiles();

        return view('admin.patients.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.patients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        return view('admin.patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        app()->setLocale('es');

        $patient->load('user');
        $blood_types = BloodType::all();

        return view('admin.patients.edit', compact('patient', 'blood_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        app()->setLocale('es');

        $validator = Validator::make($request->all(), [
            'blood_type_id' => 'nullable|exists:blood_types,id',
            'allergies' => 'nullable|string|max:255',
            'chronic_conditions' => 'nullable|string|max:255',
            'surgical_history' => 'nullable|string|max:255',
            'family_history' => 'nullable|string|max:255',
            'observations' => 'nullable|string|max:255',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'emergency_contact_relationship' => 'nullable|string|max:255',
        ], [], [
            'blood_type_id' => 'tipo de sangre',
            'allergies' => 'alergias',
            'chronic_conditions' => 'condiciones crónicas',
            'surgical_history' => 'antecedentes quirúrgicos',
            'family_history' => 'antecedentes familiares',
            'observations' => 'observaciones',
            'emergency_contact_name' => 'nombre del contacto de emergencia',
            'emergency_contact_phone' => 'teléfono del contacto de emergencia',
            'emergency_contact_relationship' => 'relación del contacto de emergencia',
        ]);

        if ($validator->fails()) {
            throw (new ValidationException($validator))
                ->redirectTo(route('admin.patients.edit', $patient));
        }

        $patient->update($validator->validated());

        session()->flash('swal', ['icon' => 'success', 'title' => '¡Éxito!', 'text' => 'Información del paciente actualizada correctamente.']);

        return redirect()->route('admin.patients.edit', $patient)->with('success', 'Información del paciente actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        //
    }
}