<x-layouts.plantilla>
    {{-- Banner --}}
    <div class="flex justify-center">
        <img src="{{ asset('img/inicio/banner-inicio.jpg') }}" alt="Imagen perros del refugio">
    </div>

    {{-- Cuerpo general --}}
    <x-general.cuerpo>
        {{-- Primera Seccion --}}
        <div class="pb-6">
            {{-- Titulo --}}
            <x-general.titular>Bienvenido a AguaraVet</x-general.titular>
        </div>
    </x-general.cuerpo>
</x-layouts.plantilla>