@props([
    'type',
    'modelModifiers' => '',
    'model',
    'id',
    'placeholder' => '',
    'required' => false])

<input
    type="{{ $type ?? null }}"
    id="{{ $id ?? null }}"
    placeholder="{{ $placeholder ?? null }}"
    wire:model{{ $modelModifiers ? '.' . $modelModifiers : '' }}="{{ $model }}"
    {{ $attributes->merge([
        'class' => 'bg-gray-50 border border-gray-300 text-gray-500 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400'
    ]) }}
    @if($required) required @endif
/>