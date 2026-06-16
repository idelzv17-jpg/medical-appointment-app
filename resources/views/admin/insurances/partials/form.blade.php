@php
    $insurance = $insurance ?? null;
@endphp

<div class="grid grid-cols-1 gap-6 md:grid-cols-2">
    <div>
        <label for="name" class="mb-2 block text-sm font-medium text-gray-700">Nombre del convenio</label>
        <input type="text" name="name" id="name" value="{{ old('name', $insurance?->name) }}" required
            placeholder="Ej. Plan Empresarial Premium"
            class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm @error('name') border-red-500 @enderror">
        @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="insurer_name" class="mb-2 block text-sm font-medium text-gray-700">Aseguradora</label>
        <input type="text" name="insurer_name" id="insurer_name" value="{{ old('insurer_name', $insurance?->insurer_name) }}" required
            placeholder="Ej. Seguros Monterrey"
            class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm @error('insurer_name') border-red-500 @enderror">
        @error('insurer_name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="agreement_code" class="mb-2 block text-sm font-medium text-gray-700">Código del convenio</label>
        <input type="text" name="agreement_code" id="agreement_code" value="{{ old('agreement_code', $insurance?->agreement_code) }}" required
            placeholder="Ej. SEG-2026-001"
            class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm @error('agreement_code') border-red-500 @enderror">
        @error('agreement_code')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="coverage_percentage" class="mb-2 block text-sm font-medium text-gray-700">Porcentaje de cobertura (%)</label>
        <input type="number" name="coverage_percentage" id="coverage_percentage" step="0.01" min="0" max="100"
            value="{{ old('coverage_percentage', $insurance?->coverage_percentage) }}"
            placeholder="Ej. 80"
            class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm @error('coverage_percentage') border-red-500 @enderror">
        @error('coverage_percentage')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="contact_phone" class="mb-2 block text-sm font-medium text-gray-700">Teléfono de contacto</label>
        <input type="text" name="contact_phone" id="contact_phone" value="{{ old('contact_phone', $insurance?->contact_phone) }}"
            placeholder="Ej. 8181234567"
            class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm @error('contact_phone') border-red-500 @enderror">
        @error('contact_phone')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="contact_email" class="mb-2 block text-sm font-medium text-gray-700">Correo de contacto</label>
        <input type="email" name="contact_email" id="contact_email" value="{{ old('contact_email', $insurance?->contact_email) }}"
            placeholder="Ej. convenios@aseguradora.com"
            class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm @error('contact_email') border-red-500 @enderror">
        @error('contact_email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div class="md:col-span-2">
        <label for="coverage_description" class="mb-2 block text-sm font-medium text-gray-700">Descripción de cobertura</label>
        <textarea name="coverage_description" id="coverage_description" rows="3"
            placeholder="Describa los servicios cubiertos por el convenio"
            class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm @error('coverage_description') border-red-500 @enderror">{{ old('coverage_description', $insurance?->coverage_description) }}</textarea>
        @error('coverage_description')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div class="md:col-span-2">
        <label for="notes" class="mb-2 block text-sm font-medium text-gray-700">Notas</label>
        <textarea name="notes" id="notes" rows="3"
            placeholder="Observaciones adicionales"
            class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm @error('notes') border-red-500 @enderror">{{ old('notes', $insurance?->notes) }}</textarea>
        @error('notes')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="inline-flex items-center gap-2 text-sm text-gray-700">
            <input type="checkbox" name="is_active" value="1"
                @checked(old('is_active', $insurance?->is_active ?? true))
                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            Convenio activo
        </label>
    </div>
</div>
