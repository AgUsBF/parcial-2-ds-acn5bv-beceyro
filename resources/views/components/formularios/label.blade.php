@props(['for'])

<label for="{{ $for ?? null }}" {{ $attributes->merge(['class' => 'text-lg text-left block mb-2 text-gray-900 dark:text-white']) }}>
    {{ $slot }}
</label>