<div class="bg-blue-100 overflow-hidden shadow-sm sm:rounded-lg mb-6">
    <div class="relative">
        <!-- Header Background -->
        <div class="h-32 bg-gradient-to-r from-primary-500 to-primary-700"></div>
        <!-- Profile Info -->
        <div class="relative px-6 pb-3">
            <div class="flex items-end space-x-6 -mt-24">
                <!-- Avatar -->
                <div class="relative">
                    <img class="h-24 w-24 rounded-full border-4 border-white object-cover bg-gray-200"
                        src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->display_name }}">
                </div>
                <!-- User Info -->
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-bold text-gray-900 mt-2">
                        {{ Auth::user()->full_name ?: Auth::user()->name }}
                    </h1>
                    <p class="text-lg text-gray-600">{{ '@'. Auth::user()->username }}</p>
                    <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                        @if(Auth::user()->location)
                        <div class="flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            {{ Auth::user()->location }}
                        </div>
                        @endif
                        @if(Auth::user()->sponsor)
                        <div class="flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                </path>
                            </svg>
                            {{ __('Sponsored by') }} {{ Auth::user()->sponsor->display_name }}
                        </div>
                        @endif
                    </div>
                </div>
                <!-- Profile Completion -->
                <div class="text-right">
                    <div class="text-sm text-gray-600 mb-1">{{ __('Profile Completion') }}</div>
                    <div class="flex items-center space-x-2">
                        <div class="w-32 bg-gray-200 rounded-full h-2">
                            <div class="bg-primary-600 h-2 rounded-full"
                                style="width: {{ Auth::user()->profile_completed }}%">
                            </div>
                        </div>
                        <span class="text-sm font-medium text-gray-900">
                            {{ Auth::user()->profile_completed }}%
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>