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
    <!-- Include Sidebar -->
    <x-dashboard-sidebar :user="Auth::user()" />
    <!-- Main Content -->
    <div class="md:pl-64 flex flex-col flex-1">
        <!-- Top Header -->
        <div class="sticky top-0 z-10 bg-white shadow-sm border-b border-gray-200">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <h2 class="font-semibold text-xl text-gray-800">Settings</h2>
                    <div class="flex items-center space-x-2">
                        <span
                            class="bg-purple-100 text-purple-800 text-xs font-semibold px-2.5 py-0.5 rounded">Settings</span>
                        <!-- Notifications Icon -->
                        <button class="relative ml-4 text-gray-500 hover:text-gray-700 focus:outline-none">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="absolute top-0 right-0 inline-block w-2 h-2 bg-red-600 rounded-full"></span>
                        </button>
                        <!-- User Dropdown -->
                        <div class="relative ml-4">
                            <button id="user-menu" type="button"
                                class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                aria-expanded="false" aria-haspopup="true">
                                <img class="h-8 w-8 rounded-full border border-gray-300 object-cover"
                                    src="{{ Auth::user()->avatar_path ? asset('storage/avatars/' . Auth::user()->avatar_path) : asset('images/default-avatar.png') }}"
                                    alt="User avatar">
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
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                                <a href="{{ route('profile') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Log
                                        Out</button>
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
        <!-- Main Content Area -->
        <div class="py-6 md:py-8 pt-20 md:pt-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-2">Settings</h3>
                        <p class="text-gray-600">This is your settings page. Add your settings options here.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>