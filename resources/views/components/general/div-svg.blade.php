@props(['color' => 'blue'])

<div class="flex justify-center">
    <svg class="h-16 w-16 text-{{ $color }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">

        {{ $slot }}

    </svg>
</div>