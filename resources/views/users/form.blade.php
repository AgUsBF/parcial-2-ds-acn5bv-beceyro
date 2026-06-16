<x-layouts.plantilla>
    <x-general.cuerpo>
        {{-- Titulo --}}
        <x-general.titular>
            Formulario de Usuario
        </x-general.titular>

        {{-- Contenido --}}
        {{ $user ? 'EDITAR' : 'CREAR' }}

    </x-general.cuerpo>

</x-layouts.plantilla>