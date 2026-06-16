<div class="flex items-center justify-end gap-2">
    <a href="{{ route('admin.appointments.consultation', $row) }}"
        title="Atender cita"
        class="inline-flex items-center justify-center rounded-lg bg-emerald-600 px-3 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-emerald-700">
        <i class="fa-solid fa-stethoscope"></i>
        <span class="sr-only">Atender cita</span>
    </a>
    <a href="{{ route('admin.appointments.edit', $row) }}"
        title="Editar cita"
        class="inline-flex items-center justify-center rounded-lg bg-primary-600 px-3 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-primary-700">
        <i class="fa-solid fa-pen-to-square"></i>
        <span class="sr-only">Editar</span>
    </a>
    <form action="{{ route('admin.appointments.destroy', $row) }}" method="POST" class="inline-block">
        @csrf
        @method('DELETE')
        <button type="submit"
            title="Eliminar cita"
            class="inline-flex items-center justify-center rounded-lg bg-red-600 px-3 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-red-700"
            onclick="return confirm('¿Estás seguro de eliminar esta cita?');">
            <i class="fa-solid fa-trash"></i>
            <span class="sr-only">Eliminar</span>
        </button>
    </form>
</div>
