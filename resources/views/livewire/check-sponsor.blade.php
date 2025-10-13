<div>
    <input type="hidden" wire:model="sponsor">
    <div class="text-xs text-gray-400">[debug] sponsor: {{ $this->sponsor }}, error: {{ $this->error }}</div>
    @if($this->error)
    <p class="mt-1 text-xs text-red-600 flex items-center">
        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                clip-rule="evenodd" />
        </svg>
        {{ $this->error }}
    </p>
    @endif
</div>