<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EFGTrack') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

    <!-- Theme System -->
    @include('components.theme.theme-system')
</head>

<body class="font-sans antialiased bg-gray-100">
    <!-- Sidebar placeholder - individual pages may include the vertical sidebar -->

    @include('components.dashboard-sidebar', ['user' => Auth::user()])

    {{--
    <livewire:layout.sidebar /> --}}

    <!-- Main Content -->
    <div class="md:pl-64 flex flex-col flex-1 min-h-screen">
        <!-- Top Navigation -->
        <div class="sticky top-0 z-10 bg-white shadow-sm border-b border-gray-200">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <h2 class="font-semibold text-xl text-gray-800">
                        @yield('page-title', config('app.name', 'EFGTrack'))
                    </h2>
                    <div class="flex items-center space-x-2">
                        @include('components.topnav-user')
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>
    @livewireScripts
</body>

</html>