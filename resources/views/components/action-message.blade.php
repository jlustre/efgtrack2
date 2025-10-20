@props(['on'])

<div x-data="{ shown: false, timeout: null }" x-init="(function(){ 
        if (typeof window !== 'undefined') {
            if (window.Livewire && typeof window.Livewire.on === 'function') {
                window.Livewire.on('{{ $on }}', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000); });
            }
            // Also listen for the DOM event dispatched by dispatchBrowserEvent
            document.addEventListener('{{ $on }}', function(e) { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000); });
        }
    })()" x-show.transition.out.opacity.duration.1500ms="shown" x-transition:leave.opacity.duration.1500ms
    style="display: none;" {{ $attributes->merge(['class' => 'text-sm text-gray-600']) }}>
    {{ $slot->isEmpty() ? __('Saved.') : $slot }}
</div>