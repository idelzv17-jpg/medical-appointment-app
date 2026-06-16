<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Insurance;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InsuranceController extends Controller
{
    public function index()
    {
        $insurances = Insurance::query()
            ->orderBy('name')
            ->get();

        return view('admin.insurances.index', compact('insurances'));
    }

    public function create()
    {
        return view('admin.insurances.create');
    }

    public function store(Request $request)
    {
        app()->setLocale('es');

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'insurer_name' => ['required', 'string', 'max:255'],
            'agreement_code' => ['required', 'string', 'max:50', 'unique:insurances,agreement_code'],
            'coverage_description' => ['nullable', 'string'],
            'coverage_percentage' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'contact_phone' => ['nullable', 'string', 'max:20'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
            'notes' => ['nullable', 'string'],
        ], [], [
            'name' => 'nombre del convenio',
            'insurer_name' => 'aseguradora',
            'agreement_code' => 'código del convenio',
            'coverage_description' => 'descripción de cobertura',
            'coverage_percentage' => 'porcentaje de cobertura',
            'contact_phone' => 'teléfono de contacto',
            'contact_email' => 'correo de contacto',
            'is_active' => 'estado',
            'notes' => 'notas',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        Insurance::create($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Convenio registrado',
            'text' => 'El convenio de seguro se guardó correctamente.',
        ]);

        return redirect()
            ->route('admin.insurances.index')
            ->with('success', 'Convenio de seguro registrado correctamente.');
    }

    public function show(Insurance $insurance)
    {
        return view('admin.insurances.show', compact('insurance'));
    }

    public function edit(Insurance $insurance)
    {
        return view('admin.insurances.edit', compact('insurance'));
    }

    public function update(Request $request, Insurance $insurance)
    {
        app()->setLocale('es');

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'insurer_name' => ['required', 'string', 'max:255'],
            'agreement_code' => ['required', 'string', 'max:50', Rule::unique('insurances', 'agreement_code')->ignore($insurance->id)],
            'coverage_description' => ['nullable', 'string'],
            'coverage_percentage' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'contact_phone' => ['nullable', 'string', 'max:20'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
            'notes' => ['nullable', 'string'],
        ], [], [
            'name' => 'nombre del convenio',
            'insurer_name' => 'aseguradora',
            'agreement_code' => 'código del convenio',
            'coverage_description' => 'descripción de cobertura',
            'coverage_percentage' => 'porcentaje de cobertura',
            'contact_phone' => 'teléfono de contacto',
            'contact_email' => 'correo de contacto',
            'is_active' => 'estado',
            'notes' => 'notas',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        $insurance->update($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Convenio actualizado',
            'text' => 'Los datos del convenio se actualizaron correctamente.',
        ]);

        return redirect()
            ->route('admin.insurances.index')
            ->with('success', 'Convenio de seguro actualizado correctamente.');
    }

    public function destroy(Insurance $insurance)
    {
        $insurance->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Convenio eliminado',
            'text' => 'El convenio de seguro fue eliminado correctamente.',
        ]);

        return redirect()
            ->route('admin.insurances.index')
            ->with('success', 'Convenio de seguro eliminado correctamente.');
    }
}
