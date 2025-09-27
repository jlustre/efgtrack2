<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Theme System -->
    @include('components.theme.theme-system')

    <style>
        .auth-background {
            background-image: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        .auth-background::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(2px);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .input-focus {
            transition: all 0.3s ease;
        }

        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="font-sans antialiased auth-background min-h-screen">
    <div class="min-h-screen flex items-center justify-center p-4 relative z-10">
        <!-- Auth Container -->
        <div class="w-full max-w-md relative z-10">
            <!-- Logo/Brand -->
            {{-- <div class="text-center mb-8">
                <a href="/" wire:navigate class="inline-block">
                    <div
                        class="bg-white rounded-full p-4 shadow-lg mb-4 hover:shadow-xl transition-shadow duration-300">
                        <x-application-logo class="w-12 h-12" />
                    </div>
                </a>
                <h1 class="text-gray-800 text-2xl font-bold mb-2">Welcome to EFGTrack</h1>
                <p class="text-gray-600 text-sm">Professional Team Management Portal</p>
            </div> --}}

            <!-- Auth Card -->
            <div class="glass-effect rounded-2xl shadow-2xl p-8">
                <h1 class="text-gray-800 text-3xl font-bold mb-2 text-center">EFGTrack</h1>
                {{ $slot }}
            </div>

            <!-- Footer Links -->
            <div class="text-center mt-6 text-gray-600 text-sm">
                <div class="flex justify-center space-x-6">
                    <a href="{{ route('landing') }}" wire:navigate
                        class="hover:text-gray-800 transition-colors">Home</a>
                    <span>•</span>
                    <a href="{{ route('privacy-policy') }}" class="hover:text-gray-800 transition-colors">Privacy</a>
                    <span>•</span>
                    <a href="{{ route('terms-of-service') }}" class="hover:text-gray-800 transition-colors">Terms</a>
                </div>
                <p class="mt-2">&copy; {{ date('Y') }} EFGTrack. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>

</html>