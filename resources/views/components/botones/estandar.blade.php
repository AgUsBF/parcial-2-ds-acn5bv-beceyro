@props(['type', 'color' => 'blue', 'padding' => 'md', 'text'=> 'text-lg'])

@php
$colores = [
    'blue' => 'bg-blue-600 hover:bg-blue-700 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800',
    'red' => 'bg-red-600 hover:bg-red-700 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800',
    'yellow' => 'bg-yellow-500 hover:bg-yellow-600 focus:ring-yellow-300 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800',
    'green' => 'bg-green-600 hover:bg-green-700 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800',
    'gray' => 'bg-gray-600 hover:bg-gray-700 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800',
];

$paddings = [
    'sm' => 'px-2.5 py-2',
    'md' => 'px-5 py-2.5',
];

$selectedColorClass = $colores[$color] ?? $colores['blue'];
$selectedPaddingClass = $paddings[$padding] ?? $paddings['md'];
@endphp

<button type="{{ $type ?? null }}" {{ $attributes->merge(['class' => 'font-medium ' . $text . ' text-center text-white rounded-lg ' . $selectedPaddingClass . ' ' .$selectedColorClass . ' ' . 'focus:ring-4 focus:outline-none']) }}>
    {{ $slot }}
</button>