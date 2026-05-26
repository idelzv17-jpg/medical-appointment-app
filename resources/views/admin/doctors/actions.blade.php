<div class="flex items-center justify-end gap-2">
    <a href="{{ route('admin.doctors.edit', $row) }}"
        title="Editar doctor"
        class="inline-flex items-center justify-center rounded-lg bg-primary-600 px-3 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
        <i class="fa-solid fa-pen-to-square"></i>
        <span class="sr-only">Editar</span>
    </a>
    <form action="{{ route('admin.doctors.destroy', $row) }}" method="POST" class="inline-block">
        @csrf
        @method('DELETE')
        <button type="submit"
            title="Eliminar doctor"
            class="inline-flex items-center justify-center rounded-lg bg-red-600 px-3 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
            onclick="return confirm('¿Estás seguro de eliminar este doctor?');">
            <i class="fa-solid fa-trash"></i>
            <span class="sr-only">Eliminar</span>
        </button>
    </form>
</div>
