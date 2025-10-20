<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
    <div class="p-6 flex items-center justify-between">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Welcome back, :name!', ['name' => Auth::user()->name]) }}
            </h2>
            @if (!empty($subhead))
            <p class="text-gray-600 mt-1">{{ $subhead }}</p>
            @endif
        </div>
    </div>
</div>