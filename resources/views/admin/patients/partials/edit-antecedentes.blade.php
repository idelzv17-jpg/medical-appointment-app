<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <x-textarea label="Alergias" name="allergies" rows="3"
            placeholder="Listado de alergias (medicamentos, alimentos, etc.)">{{ old('allergies', $patient->allergies) }}</x-textarea>
    </div>

    <div>
        <x-textarea label="Condiciones Crónicas" name="chronic_conditions" rows="3"
            placeholder="Ej: Diabetes, Hipertensión...">{{ old('chronic_conditions', $patient->chronic_conditions) }}</x-textarea>
    </div>

    <div>
        <x-textarea label="Historial Quirúrgico" name="surgical_history" rows="3"
            placeholder="Cirugías previas y fechas aproximadas...">{{ old('surgical_history', $patient->surgical_history) }}</x-textarea>
    </div>

    <div>
        <x-textarea label="Historia Familiar" name="family_history" rows="3"
            placeholder="Antecedentes médicos relevantes en la familia...">{{ old('family_history', $patient->family_history) }}</x-textarea>
    </div>
</div>
