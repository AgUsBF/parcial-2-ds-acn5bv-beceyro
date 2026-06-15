<x-layouts.plantilla>
    <x-general.cuerpo>
        {{-- Titulo --}}
        <x-general.titular>
            Formulario de Especies
        </x-general.titular>

        {{-- Contenido --}}
        {{ $specie ? 'EDITAR' : 'CREAR' }}

    </x-general.cuerpo>

</x-layouts.plantilla>