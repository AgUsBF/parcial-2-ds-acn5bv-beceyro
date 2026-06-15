@props(['color', 'title', 'ruta'])

<div class="mt-4">
    <a href="{{ $ruta ? route($ruta) : '#' }}" class="inline-flex items-center px-4 py-2 bg-{{ $color }}-600 
        border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest 
        hover:bg-{{ $color }}-700 focus:bg-{{ $color }}-700 active:bg-{{ $color }}-900 focus:outline-none 
        focus:ring-2 focus:ring-{{ $color }}-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 
        transition ease-in-out duration-150">

        {{ $title }}

    </a>
</div>