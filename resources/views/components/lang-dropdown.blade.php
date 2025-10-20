@php
$current = session('locale', app()->getLocale());
$locales = [
'en' => __('English'),
'es' => __('Spanish'),
];
// inline SVG flags (simple lightweight visuals). Replace or extend as needed.
$flagSvgs = [
'en' => '<svg class="h-5 w-5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
    <rect width="24" height="24" fill="#b22234" />
    <g fill="#fff">
        <rect y="2" width="24" height="2" />
        <rect y="6" width="24" height="2" />
        <rect y="10" width="24" height="2" />
        <rect y="14" width="24" height="2" />
        <rect y="18" width="24" height="2" />
    </g>
    <rect x="2" y="2" width="10" height="8" fill="#3c3b6e" />
    <g fill="#fff">
        <circle cx="3.5" cy="3.5" r="0.6" />
        <circle cx="6.5" cy="3.5" r="0.6" />
        <circle cx="9.5" cy="3.5" r="0.6" />
        <circle cx="4.5" cy="5.5" r="0.6" />
        <circle cx="7.5" cy="5.5" r="0.6" />
    </g>
</svg>',
// Mexican flag: vertical green, white, red stripes (simplified)
'es' => '<svg class="h-5 w-5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
    <rect width="8" height="24" x="0" y="0" fill="#006847" />
    <rect width="8" height="24" x="8" y="0" fill="#ffffff" />
    <rect width="8" height="24" x="16" y="0" fill="#ce1126" />
</svg>',
];
@endphp

<div x-data="{ open: false }" @click.away="open = false" @keydown.escape.window="open = false"
    class="relative inline-block text-left me-4">
    <div>
        <button type="button" @click.prevent="open = !open" :aria-expanded="open.toString()"
            class="inline-flex items-center px-2 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none"
            id="lang-menu-button" aria-haspopup="true">
            <span class="mr-2 inline-block" aria-hidden="true">{!! $flagSvgs[$current] ?? '🌐' !!}</span>
            <span class="sr-only">{{ __('Language') }}</span>
            <span class="text-xs">{{ strtoupper($current) }}</span>
        </button>
    </div>
    <div :class="{ 'hidden': !open }"
        class="origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
        role="menu" aria-orientation="vertical" aria-labelledby="lang-menu-button">
        <div class="py-1" role="none">
            @foreach($locales as $code => $label)
            @php $isActive = ($code === $current); @endphp
            <a href="{{ route('lang.switch', $code) }}"
                class="flex items-center justify-between px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                role="menuitem" aria-current="{{ $isActive ? 'true' : 'false' }}">
                <div class="flex items-center space-x-2">
                    <span class="inline-block mr-2" aria-hidden="true">{!! $flagSvgs[$code] ?? '🌐' !!}</span>
                    <span>{{ $label }}</span>
                </div>
                @if($isActive)
                <svg class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                </svg>
                @endif
            </a>
            @endforeach
        </div>
    </div>
</div>