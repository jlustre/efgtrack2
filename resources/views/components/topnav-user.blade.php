<div class="sticky top-0 z-10 bg-white shadow-sm border-b border-gray-200">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center space-x-2">
                <!-- Notifications Icon -->
                @include('components.notifications')

                <!-- Language selector (placed beside notifications) -->
                @include('components.lang-dropdown')

                <!-- User Dropdown -->
                <div class="relative ml-4">
                    <button id="user-menu" type="button"
                        class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        aria-expanded="false" aria-haspopup="true">
                        <img class="h-8 w-8 rounded-full border border-gray-300 object-cover"
                            src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->display_name }}">
                        <span class="ml-2 font-medium text-gray-700">{{ Auth::user()->name }}</span>
                        <svg class="ml-1 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 20 20" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="user-menu-dropdown"
                        class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg py-1 z-50">
                        <a href="{{ route('settings') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ __('Settings') }}</a>
                        <a href="{{ route('profile') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ __('Profile') }}</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{
                                __('Logout') }}</button>
                        </form>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                var userMenuBtn = document.getElementById('user-menu');
                var userMenuDropdown = document.getElementById('user-menu-dropdown');
                userMenuBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    userMenuDropdown.classList.toggle('hidden');
                });
                document.addEventListener('click', function () {
                    userMenuDropdown.classList.add('hidden');
                });
            });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>