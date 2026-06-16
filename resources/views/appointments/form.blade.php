<x-layouts.plantilla>
    <x-general.cuerpo>
        {{-- Titulo --}}
        <x-general.titular>
            Formulario de Turno
        </x-general.titular>

        {{-- Contenido --}}
        {{ $appointment ? 'EDITAR' : 'CREAR' }}

    </x-general.cuerpo>

</x-layouts.plantilla>