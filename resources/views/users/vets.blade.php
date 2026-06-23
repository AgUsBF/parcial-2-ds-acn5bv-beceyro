<x-layouts.plantilla>
    <x-general.cuerpo>
        {{-- Titulo --}}
        <x-general.titular>
            Veterinarios
        </x-general.titular>

        {{-- Contenido --}}
        <div class="flex-column px-8">
            {{-- Tabla --}}
            <div class="py-4 px-8 w-full flex flex-col justify-center items-center livewire-table">

                <livewire:vet-table />

            </div>
        </div>
    </x-general.cuerpo>
</x-layouts.plantilla>