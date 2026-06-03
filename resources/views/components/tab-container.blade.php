@props(['defaultTab' => '', 'errorTab' => ''])

@php
    $activeTab = $errorTab ?: $defaultTab;
@endphp

<div class="tab-container" data-active-tab="{{ $activeTab }}">
    {{ $slot }}
</div>

@once
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('.tab-container').forEach(function (container) {
                    const buttons = container.querySelectorAll('[data-tab-target]');
                    const panels = container.querySelectorAll('[data-tab-panel]');

                    function activateTab(target) {
                        panels.forEach(function (panel) {
                            panel.classList.toggle('hidden', panel.getAttribute('data-tab-panel') !== target);
                        });

                        buttons.forEach(function (button) {
                            const isActive = button.getAttribute('data-tab-target') === target;
                            const hasErrors = button.getAttribute('data-has-errors') === 'true';

                            button.classList.remove(
                                'border-blue-500', 'text-blue-600',
                                'border-red-500', 'text-red-600',
                                'border-transparent', 'text-gray-500', 'text-red-400'
                            );

                            if (isActive && hasErrors) {
                                button.classList.add('border-red-500', 'text-red-600');
                            } else if (isActive) {
                                button.classList.add('border-blue-500', 'text-blue-600');
                            } else if (hasErrors) {
                                button.classList.add('border-transparent', 'text-red-400');
                            } else {
                                button.classList.add('border-transparent', 'text-gray-500');
                            }
                        });
                    }

                    buttons.forEach(function (button) {
                        button.addEventListener('click', function () {
                            activateTab(button.getAttribute('data-tab-target'));
                        });
                    });
                });
            });
        </script>
    @endpush
@endonce
