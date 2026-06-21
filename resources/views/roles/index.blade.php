<x-layouts.plantilla>
    <x-general.cuerpo>
        {{-- Titulo --}}
        <x-general.titular>
            Roles
        </x-general.titular>

        {{-- Contenido --}}
        <div class="flex-column px-8 max-w-7xl mx-auto">
            {{-- Mensajes de feedback --}}
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                    role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Botonera --}}
            <div class="w-full flex flex-row justify-end px-8 mb-4">
                <a href="{{ route('roles.create') }}" class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 
                    focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 
                    focus:outline-none dark:focus:ring-blue-800">
                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                    </svg>

                    Nuevo
                </a>
            </div>

            {{-- Tabla --}}
            <div class="py-4 px-8 w-full flex flex-col justify-center items-center livewire-table bg-white 
                dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm">
                <livewire:role-table />
            </div>
        </div>

        {{-- Modal de Confirmación de Eliminación --}}
        <div id="delete-role-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center 
                w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div
                    class="relative bg-white rounded-lg shadow-md dark:bg-gray-700 border border-gray-200 dark:border-gray-600">
                    <div
                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Confirmar Eliminación
                        </h3>

                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            onclick="closeModal('delete-role-modal')">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewbox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>

                            <span class="sr-only">Cerrar modal</span>
                        </button>
                    </div>

                    <div class="p-4 md:p-5">
                        <p class="text-mg font-normal text-gray-500 dark:text-gray-400 mb-5">
                            ¿Estás seguro de que deseas eliminar el rol
                            <span id="delete-role-name" class="font-semibold text-gray-900 dark:text-white"></span>?
                            Esta acción no se puede deshacer.
                        </p>

                        <form id="delete-role-form" action="" method="POST">
                            @csrf
                            @method('DELETE')

                            <div class="flex justify-end space-x-3">
                                <button type="button"
                                    class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white 
                                    rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 
                                    focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 
                                    dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                                    onclick="closeModal('delete-role-modal')">
                                    Cancelar
                                </button>

                                <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none 
                                        focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm 
                                        inline-flex items-center px-5 py-2.5 text-center">
                                    Eliminar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function confirmDelete(url, name) {
                document.getElementById('delete-role-form').action = url;
                document.getElementById('delete-role-name').textContent = name;

                // Abrir modal usando el evento global
                window.dispatchEvent(new CustomEvent('open-modal', {
                    detail: ['delete-role-modal']
                }));
            }
        </script>
    </x-general.cuerpo>
</x-layouts.plantilla>