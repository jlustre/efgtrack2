<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Profile Management') }}
            </h2>
            <div class="flex items-center space-x-3">
                <span
                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ Auth::user()->member_status_color }}-100 text-{{ Auth::user()->member_status_color }}-800">
                    {{ Auth::user()->member_status_label }}
                </span>
                @if(!Auth::user()->profile_completed)
                <span
                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                    Profile Incomplete
                </span>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Profile Header Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="relative">
                    <!-- Header Background -->
                    <div class="h-32 bg-gradient-to-r from-primary-500 to-primary-700"></div>

                    <!-- Profile Info -->
                    <div class="relative px-6 pb-6">
                        <div class="flex items-end space-x-6 -mt-16">
                            <!-- Avatar -->
                            <div class="relative">
                                <img class="h-24 w-24 rounded-full border-4 border-white object-cover bg-gray-200"
                                    src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->display_name }}">
                                <div class="absolute bottom-0 right-0 bg-white rounded-full p-1">
                                    <div
                                        class="h-4 w-4 rounded-full bg-{{ Auth::user()->member_status === 'active' ? 'green' : 'gray' }}-400">
                                    </div>
                                </div>
                            </div>

                            <!-- User Info -->
                            <div class="flex-1 min-w-0">
                                <h1 class="text-2xl font-bold text-gray-900 mt-2">
                                    {{ Auth::user()->full_name ?: Auth::user()->name }}
                                </h1>
                                <p class="text-lg text-gray-600">@{{ Auth::user()->username }}</p>
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
                                        Sponsored by {{ Auth::user()->sponsor->display_name }}
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Profile Completion -->
                            <div class="text-right">
                                <div class="text-sm text-gray-600 mb-1">Profile Completion</div>
                                <div class="flex items-center space-x-2">
                                    <div class="w-32 bg-gray-200 rounded-full h-2">
                                        <div class="bg-primary-600 h-2 rounded-full"
                                            style="width: {{ Auth::user()->isProfileComplete() ? 100 : 60 }}%"></div>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900">
                                        {{ Auth::user()->isProfileComplete() ? 100 : 60 }}%
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Left Column - Main Forms -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Personal Information -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Personal Information</h3>
                            <p class="mt-1 text-sm text-gray-600">Update your personal details and contact information.
                            </p>
                        </div>
                        <div class="p-6">
                            <livewire:profile.update-profile-information-form />
                        </div>
                    </div>

                    <!-- Location & Contact -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Location & Contact</h3>
                            <p class="mt-1 text-sm text-gray-600">Manage your location and contact preferences.</p>
                        </div>
                        <div class="p-6">
                            <livewire:profile.update-location-form />
                        </div>
                    </div>

                    <!-- Theme Preferences -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Theme Preferences</h3>
                            <p class="mt-1 text-sm text-gray-600">Customize your visual experience.</p>
                        </div>
                        <div class="p-6">
                            @include('components.theme.theme-selector-ui')
                        </div>
                    </div>

                    <!-- Security -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Security</h3>
                            <p class="mt-1 text-sm text-gray-600">Manage your password and account security.</p>
                        </div>
                        <div class="p-6">
                            <livewire:profile.update-password-form />
                        </div>
                    </div>
                </div>

                <!-- Right Column - Sidebar -->
                <div class="space-y-6">

                    <!-- Quick Stats -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Your Stats</h3>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Recruits Created</span>
                                    <span class="text-sm font-medium text-gray-900">{{
                                        Auth::user()->createdRecruits->count() }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Active Mentorships</span>
                                    <span class="text-sm font-medium text-gray-900">{{
                                        Auth::user()->mentoredRecruits->where('status', '!=', 'terminated')->count()
                                        }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Sponsored Members</span>
                                    <span class="text-sm font-medium text-gray-900">{{
                                        Auth::user()->sponsoredMembers->count() }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Member Since</span>
                                    <span class="text-sm font-medium text-gray-900">{{
                                        Auth::user()->created_at->format('M Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Avatar Upload -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Profile Picture</h3>
                            <livewire:profile.avatar-upload />
                        </div>
                    </div>

                    <!-- Sponsorship Info -->
                    @if(Auth::user()->sponsor || Auth::user()->sponsoredMembers->count() > 0)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Network</h3>

                            @if(Auth::user()->sponsor)
                            <div class="mb-4 p-3 bg-gray-50 rounded-lg">
                                <div class="text-xs text-gray-500 uppercase tracking-wide mb-1">Your Sponsor</div>
                                <div class="flex items-center space-x-3">
                                    <img class="h-8 w-8 rounded-full" src="{{ Auth::user()->sponsor->avatar_url }}"
                                        alt="">
                                    <div>
                                        <div class="text-sm font-medium">{{ Auth::user()->sponsor->full_name }}</div>
                                        <div class="text-xs text-gray-500">@{{ Auth::user()->sponsor->username }}</div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if(Auth::user()->sponsoredMembers->count() > 0)
                            <div>
                                <div class="text-xs text-gray-500 uppercase tracking-wide mb-2">Your Network ({{
                                    Auth::user()->sponsoredMembers->count() }})</div>
                                <div class="space-y-2">
                                    @foreach(Auth::user()->sponsoredMembers->take(3) as $member)
                                    <div class="flex items-center space-x-3 text-sm">
                                        <img class="h-6 w-6 rounded-full" src="{{ $member->avatar_url }}" alt="">
                                        <span>{{ $member->full_name }}</span>
                                    </div>
                                    @endforeach
                                    @if(Auth::user()->sponsoredMembers->count() > 3)
                                    <div class="text-xs text-gray-500">+{{ Auth::user()->sponsoredMembers->count() - 3
                                        }} more</div>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Account Actions -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Account Actions</h3>
                            <div class="space-y-3">
                                <button
                                    class="w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-md">
                                    Export My Data
                                </button>
                                <button
                                    class="w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-md">
                                    Download Activity Report
                                </button>
                                <hr class="my-2">
                                <button
                                    class="w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-red-50 rounded-md"
                                    onclick="document.getElementById('delete-account-section').scrollIntoView()">
                                    Delete Account
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delete Account Section -->
            <div id="delete-account-section"
                class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-red-400">
                <div class="p-6">
                    <livewire:profile.delete-user-form />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>