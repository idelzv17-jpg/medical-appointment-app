@props([
    'tabId',
    'icon',
    'label',
    'hasError' => false,
])

<a href="#"
    x-on:click.prevent="tab = '{{ $tabId }}'"
    class="inline-flex items-center justify-center gap-2 p-4 border-b-2 rounded-t-lg font-medium transition-colors duration-200
        {{ $hasError ? '!text-red-600' : 'text-gray-500' }}"
    :class="tab === '{{ $tabId }}'
        ? '{{ $hasError ? '!border-red-600 !text-red-600' : '!border-blue-600 !text-blue-600' }}'
        : 'border-transparent {{ $hasError ? 'hover:!border-red-400' : 'hover:text-blue-600 hover:border-gray-300' }}'">
    @if ($hasError)
        <span
            class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-red-100 text-red-600 text-xs"
            x-show="tab !== '{{ $tabId }}'"
            x-cloak
            title="Hay errores en esta sección">
            <i class="fa-solid fa-exclamation"></i>
        </span>
    @endif
    <i class="fa-solid {{ $icon }} {{ $hasError ? 'text-red-600' : '' }}"></i>
    <span>{{ $label }}</span>
</a>
