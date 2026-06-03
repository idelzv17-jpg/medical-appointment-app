@props(['name', 'icon' => '', 'hasErrors' => false, 'active' => false])

<button
    type="button"
    data-tab-target="{{ $name }}"
    data-has-errors="{{ $hasErrors ? 'true' : 'false' }}"
    {{ $attributes->class([
        'tab-button flex items-center whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm',
        'border-blue-500 text-blue-600' => $active && ! $hasErrors,
        'border-red-500 text-red-600' => $active && $hasErrors,
        'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' => ! $active && ! $hasErrors,
        'border-transparent text-red-400 hover:text-red-600 hover:border-red-300' => ! $active && $hasErrors,
    ]) }}
>
    @if ($icon)
        <i class="{{ $icon }} mr-2"></i>
    @endif
    {{ $slot }}
    @if ($hasErrors)
        <span class="ml-2 w-2.5 h-2.5 bg-orange-500 rounded-full inline-block"></span>
    @endif
</button>
