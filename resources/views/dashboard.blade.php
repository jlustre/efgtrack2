@extends('layouts.app')
@livewire('profile.complete-profile-modal')
@include('components.welcome', ['subhead' => __('Welcome back — here are your latest updates')])

@section('page-title')
{{ __('Dashboard') }}
@endsection

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

    <!-- Quick Statistics -->
    @include('components.statistics')


    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Activity -->
        <div class="lg:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Recent Activity') }}</h3>
                <div class="space-y-4">
                    <!-- Welcome Message -->
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <div class="bg-primary-100 rounded-full p-2">
                                <svg class="h-4 w-4 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-900">{{ __('Welcome to EFGTrack! Get started by adding your
                                first recruit or setting up your profile.') }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ now()->format('M j, Y \a\t g:i A') }}</p>
                        </div>
                    </div>

                    <!-- Theme System Activity -->
                    @if(Auth::user()->theme_settings)
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <div class="bg-purple-100 rounded-full p-2">
                                <svg class="h-4 w-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 2a2 2 0 00-2 2v11a3 3 0 106 0V4a2 2 0 00-2-2H4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-900">{{ __('Theme preference saved: :theme', ['theme' =>
                                json_decode(Auth::user()->theme_settings)->theme ?? 'Blue Ocean']) }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ __('Customization updated') }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Empty State -->
                    <div class="text-center py-8 text-gray-500">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="mt-2">{{ __('No recent activity yet') }}</p>
                        <p class="text-sm">{{ __('Activity will appear here as you use EFGTrack') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Quick Actions') }}</h3>
                <div class="space-y-3">
                    <a href="{{ route('recruits.create') }}"
                        class="w-full bg-primary-600 hover:bg-primary-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 flex items-center justify-center">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        {{ __('Add New Recruit') }}
                    </a>

                    <button
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 flex items-center justify-center">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                        {{ __('Assign Mentor') }}
                    </button>

                    <button
                        class="w-full bg-yellow-600 hover:bg-yellow-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 flex items-center justify-center">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                            </path>
                        </svg>
                        {{ __('Create Checklist') }}
                    </button>

                    <a href="{{ route('profile') }}"
                        class="w-full bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 flex items-center justify-center">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        {{ __('Edit Profile') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Welcome Guide -->
    <div class="bg-gradient-to-r from-primary-50 to-primary-100 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <div class="bg-primary-600 rounded-full p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-medium text-primary-800 mb-2">{{ __('Getting Started with EFGTrack') }}</h3>
                    <p class="text-primary-700 mb-4">{{ __('Welcome to your team management portal! Here\'s how to get
                        the most out of EFGTrack:') }}</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-start space-x-3">
                            <div class="bg-primary-200 rounded-full p-1 mt-0.5">
                                <svg class="h-3 w-3 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="text-sm text-primary-700">{{ __('Customize your experience with themes')
                                }}</span>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="bg-primary-200 rounded-full p-1 mt-0.5">
                                <svg class="h-3 w-3 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="text-sm text-primary-700">{{ __('Add recruits and track their progress')
                                }}</span>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="bg-primary-200 rounded-full p-1 mt-0.5">
                                <svg class="h-3 w-3 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="text-sm text-primary-700">{{ __('Set up mentoring relationships') }}</span>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="bg-primary-200 rounded-full p-1 mt-0.5">
                                <svg class="h-3 w-3 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="text-sm text-primary-700">{{ __('Create onboarding checklists') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection