<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @include('components.theme-system')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">
    <!-- Include Sidebar (Livewire layout.navigation) -->
    <livewire:layout.navigation :user="$user ?? auth()->user()" :viewingContext="$viewingContext ?? null" />

    <!-- Main Content -->
    <div class="md:pl-64 flex flex-col flex-1">
        <!-- Top Header -->
        <div class="sticky top-0 z-10 bg-white shadow-sm border-b border-gray-200">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <h2 class="font-semibold text-xl text-gray-800">
                        Dashboard
                    </h2>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="py-6 md:py-8 pt-20 md:pt-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-2 text-lg font-medium text-gray-900">Welcome, {{ ($user ??
                                auth()->user())->name }}!</h3>
                            <p class="mt-2 text-sm text-gray-500">
                                Your account is being set up. You'll be assigned a role soon to access specific
                                features.
                            </p>
                            <div class="mt-6">
                                <p class="text-sm text-gray-400">
                                    If you need immediate access, please contact your administrator.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @livewire('profile.complete-profile-modal')
</body>

</html>