@props(['href'])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'text-lg font-medium text-blue-600 hover:underline dark:text-blue-500']) }}>
    {{ $slot }}
</a>