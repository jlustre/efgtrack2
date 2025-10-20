@props(['type' => 'success', 'message' => null])

@php
$bg = $type === 'error' ? 'bg-red-50 border-red-300 text-red-800' : 'bg-green-50 border-green-300 text-green-800';
$icon = $type === 'error' ? 'M18 8.25V6a2 2 0 00-2-2h-8a2 2 0 00-2 2v2.25M6 13.5v3.75A2.25 2.25 0 008.25 19.5h7.5A2.25
2.25 0 0018 17.25V13.5M9 9h6' : 'M5 13l4 4L19 7';
@endphp

<div x-data="{ show: true }" x-show="show" x-transition class="mb-4">
    <div class="rounded-md p-4 border {{ $bg }} shadow-sm">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}" />
                </svg>
            </div>
            <div class="ml-3 flex-1">
                <p class="text-sm font-medium">{{ $message ?? session('status_message') ?? session('status') }}</p>
                @if(session('status_message_more'))
                <p class="text-xs mt-1 text-gray-600">{{ session('status_message_more') }}</p>
                @endif
            </div>
            <div class="ml-4 flex-shrink-0 flex items-start">
                <button @click="show = false" class="inline-flex text-gray-500 hover:text-gray-700 focus:outline-none">
                    <span class="sr-only">Dismiss</span>
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>