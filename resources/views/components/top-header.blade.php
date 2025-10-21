<div class="sticky top-0 z-10 bg-white shadow-sm border-b border-gray-200">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <h2 class="font-semibold text-xl text-gray-800">
                {{ $title_hdr ?? __('Dashboard') }}
                @if(isset($viewingContext))
                <span class="text-sm font-normal text-gray-600 ml-2">
                    (Viewing as {{ $viewingContext['viewing_as'] }})
                </span>
                @endif
            </h2>
            @include('components.topnav-user')
        </div>
    </div>
</div>