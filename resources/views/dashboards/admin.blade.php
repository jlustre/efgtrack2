@extends('layouts.admin')

@section('content')

<!-- Main Content -->
<div class="md:pl-64 flex flex-col flex-1">
    <!-- Top Header -->
    @include('components.topnav-user', ['title_hdr' => __('Admin Dashboard')])

    <!-- Main Content Area -->
    <div class="py-6 md:py-8 pt-20 md:pt-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            @include('components.welcome', ['subhead'=> __('System Administrator - Full Access')])

            {{-- @if(config('app.debug') && Auth::check())
            <div class="mt-4">
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                    <p class="text-sm text-yellow-700">Debug: app()->getLocale() = <strong>{{ app()->getLocale()
                            }}</strong></p>
                    <p class="text-sm text-yellow-700">Debug: Auth user language = <strong>{{ Auth::user()->language ??
                            'NULL' }}</strong></p>
                </div>
            </div>
            @endif --}}

            <!-- Stats Grid -->
            @include('components.statistics', ['stats' => $stats])

            <!-- Admin Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">{{ __('System Management') }}</h3>
                        <div class="space-y-3">
                            @include('components.admin-action', [
                            'route' => route('users.index'),
                            'label' => __('Manage Users'),
                            'icon' => '<svg class="h-5 w-5 text-gray-500 group-hover:text-gray-900" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                    clip-rule="evenodd" />
                            </svg>'
                            ])

                            @include('components.admin-action', [
                            'route' => '#',
                            'label' => __('System Settings'),
                            'icon' => '<svg class="h-5 w-5 text-gray-500 group-hover:text-gray-900" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd" />
                            </svg>'
                            ])

                            @include('components.admin-action', [
                            'route' => '/telescope',
                            'label' => __('Laravel Telescope'),
                            'icon' => '<svg class="h-5 w-5 text-gray-500 group-hover:text-gray-900" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>'
                            ])
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">{{ __('Quick Access') }}</h3>
                        <div class="space-y-3">
                            @include('components.admin-action', [
                            'route' => '#',
                            'label' => __('View All Dashboards'),
                            'icon' => '<svg class="h-5 w-5 text-gray-500 group-hover:text-gray-900" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>'
                            ])

                            @include('components.admin-action', [
                            'route' => '#',
                            'label' => __('System Reports'),
                            'icon' => '<svg class="h-5 w-5 text-gray-500 group-hover:text-gray-900" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd" />
                            </svg>'
                            ])

                            @include('components.admin-action', [
                            'route' => '#',
                            'label' => __('Announcements'),
                            'icon' => '<svg class="h-5 w-5 text-gray-500 group-hover:text-gray-900" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 3a1 1 0 00-1.447-.894L8.763 6H5a3 3 0 000 6h.28l1.771 5.316A1 1 0 008 18h1a1 1 0 001-1v-4.382l6.553 3.276A1 1 0 0018 15V3z"
                                    clip-rule="evenodd" />
                            </svg>'
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection