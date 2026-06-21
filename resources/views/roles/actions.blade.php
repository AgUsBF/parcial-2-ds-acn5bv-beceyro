<div class="flex items-center space-x-2 justify-start">
    {{-- Ver --}}
    <a href="{{ route('roles.show', $row->id) }}" 
       class="inline-flex items-center justify-center p-1.5 text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700" 
       title="Ver detalle">
        <span class="material-icons text-xl">visibility</span>
    </a>

    {{-- Editar --}}
    <a href="{{ route('roles.edit', $row->id) }}" 
       class="inline-flex items-center justify-center p-1.5 text-blue-600 rounded-lg hover:text-blue-900 hover:bg-gray-100 dark:text-blue-500 dark:hover:text-blue-400 dark:hover:bg-gray-700" 
       title="Editar">
        <span class="material-icons text-xl">edit</span>
    </a>

    {{-- Eliminar --}}
    <button type="button" 
            onclick="confirmDelete('{{ route('roles.destroy', $row->id) }}', '{{ addslashes($row->name) }}')"
            class="inline-flex items-center justify-center p-1.5 text-red-600 rounded-lg hover:text-red-900 hover:bg-gray-100 dark:text-red-500 dark:hover:text-red-400 dark:hover:bg-gray-700" 
            title="Eliminar">
        <span class="material-icons text-xl">delete</span>
    </button>
</div>
