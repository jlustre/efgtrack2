@props(["route" => '#', "label" => '', "icon" => ''])

<a href="{{ $route }}"
    class="flex items-center p-3 text-base font-medium text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group">
    {!! $icon !!}
    <span class="ml-3">{{ __($label) }}</span>
</a>