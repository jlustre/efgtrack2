@props(['title' => '', 'value' => '', 'iconBg' => 'bg-gray-200', 'icon' => ''])

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6">
        <div class="flex items-center">
            <div class="p-2 rounded-md {{ $iconBg }}">
                {{-- Icon HTML (raw) --}}
                {!! $icon !!}
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">{{ $title }}</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $value }}</p>
            </div>
        </div>
    </div>
</div>