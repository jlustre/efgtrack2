{{--
Landing Page Navigation Component
Contains the sticky navigation bar with logo and auth links
--}}
<nav class="bg-white shadow-sm sticky top-0 z-40 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <div class="flex-shrink-0 flex items-center">
                    <svg class="h-8 w-8 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z" />
                    </svg>
                    <span class="ml-2 text-xl font-bold text-gray-900">EFGTrack</span>
                </div>
            </div>

            @if (Route::has('login'))
            <div class="flex items-center space-x-4">
                @auth
                <a href="{{ url('/dashboard') }}"
                    class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition duration-200">Dashboard</a>
                <livewire:nav-logout-button />
                @else
                <a href="{{ route('login') }}"
                    class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Sign In</a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}"
                    class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition duration-200">Get
                    Started</a>
                @endif
                @endauth
            </div>
            @endif
        </div>
    </div>
</nav>