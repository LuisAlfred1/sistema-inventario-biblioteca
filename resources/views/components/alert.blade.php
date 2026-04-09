@props(['type' => 'success', 'message'])

@php
    $styles = [
        'success' => [
            'bg' => 'bg-green-50 border-green-400',
            'text' => 'text-green-700',
            'icon' => 'bi-check-circle-fill text-green-500',
        ],
        'error' => [
            'bg' => 'bg-red-50 border-red-400',
            'text' => 'text-red-700',
            'icon' => 'bi-x-circle-fill text-red-500',
        ],
    ];

    $style = $styles[$type];
@endphp

<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2500)" x-transition:enter="transition ease-out duration-500"
    x-transition:enter-start="opacity-0 -translate-x-4" x-transition:enter-end="opacity-100 translate-x-0"
    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-x-0"
    x-transition:leave-end="opacity-0 -translate-x-4"
    class="flex items-center gap-3 px-4 py-1 border-l-4 rounded-lg shadow-sm {{ $style['bg'] }}">

    <div class="flex items-center gap-2">
        <i class="bi {{ $style['icon'] }} text-lg"></i>
        <span class="text-sm font-medium {{ $style['text'] }}">{{ $message }}</span>
    </div>

    <button @click="show = false" class="text-gray-400 hover:text-gray-600 transition">
        <i class="bi bi-x text-lg"></i>
    </button>
</div>
