<x-layouts.plantilla>
    <x-general.cuerpo>
        {{-- Titulo --}}
        <x-general.titular>
            Mascotas
        </x-general.titular>

        {{-- Contenido --}}
        <div class="flex-column px-8">
            {{-- Botonera --}}
            <div class="w-full flex flex-row justify-end px-8">
                <a href="{{ route('animals.create') }}" 
                    class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 
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
            <div class="py-4 px-8 w-full flex flex-col justify-center items-center livewire-table">

                <livewire:animal-table />

            </div>
        </div>

    </x-general.cuerpo>

</x-layouts.plantilla>