<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <x-native-select label="Tipo de sangre" name="blood_type_id">
                <option value="">Seleccione una opción</option>
                @foreach ($blood_types as $type)
                    <option value="{{ $type->id }}" @selected(old('blood_type_id', $patient->blood_type_id) == $type->id)>
                        {{ $type->name }}
                    </option>
                @endforeach
            </x-native-select>
        </div>

        <div class="md:col-span-2">
            <x-textarea label="Observaciones generales" name="observations" rows="3"
                placeholder="Notas relevantes sobre el paciente...">{{ old('observations', $patient->observations) }}</x-textarea>
        </div>
    </div>
</div>
