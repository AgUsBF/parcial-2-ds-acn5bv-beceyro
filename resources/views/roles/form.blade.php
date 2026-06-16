<x-layouts.plantilla>
    <x-general.cuerpo>
        {{-- Titulo --}}
        <x-general.titular>
            Formulario de Roles
        </x-general.titular>

        {{-- Contenido --}}
        {{ $role ? 'EDITAR' : 'CREAR' }}

    </x-general.cuerpo>

</x-layouts.plantilla>