<x-layouts.plantilla>
    <x-general.cuerpo>
        {{-- Titulo --}}
        <x-general.titular>
            Formulario de Mascotas
        </x-general.titular>

        {{-- Contenido --}}
        {{ $animal ? 'EDITAR' : 'CREAR' }}

    </x-general.cuerpo>

</x-layouts.plantilla>