@props(['name', 'active' => false])

<div data-tab-panel="{{ $name }}" {{ $attributes->class(['tab-panel', 'hidden' => ! $active]) }}>
    {{ $slot }}
</div>
