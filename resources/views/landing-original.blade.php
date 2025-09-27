<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EFGTrack - Team Management Portal</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Dynamic Theme CSS -->
    <style id="dynamic-theme">
        :root {
            /* Primary Colors */
            --primary-50: 239 246 255;
            --primary-100: 219 234 254;
            --primary-200: 191 219 254;
            --primary-300: 147 197 253;
            --primary-400: 96 165 250;
            --primary-500: 59 130 246;
            --primary-600: 37 99 235;
            --primary-700: 29 78 216;
            --primary-800: 30 64 175;
            --primary-900: 30 58 138;

            /* Secondary Colors */
            --secondary-50: 249 250 251;
            --secondary-100: 243 244 246;
            --secondary-200: 229 231 235;
            --secondary-300: 209 213 219;
            --secondary-400: 156 163 175;
            --secondary-500: 107 114 128;
            --secondary-600: 75 85 99;
            --secondary-700: 55 65 81;
            --secondary-800: 31 41 55;
            --secondary-900: 17 24 39;

            /* Accent Colors */
            --accent-50: 240 253 244;
            --accent-100: 220 252 231;
            --accent-200: 187 247 208;
            --accent-300: 134 239 172;
            --accent-400: 74 222 128;
            --accent-500: 34 197 94;
            --accent-600: 22 163 74;
            --accent-700: 21 128 61;
            --accent-800: 22 101 52;
            --accent-900: 20 83 45;
        }

        /* Dynamic color applications */
        .bg-primary-50 {
            background-color: rgb(var(--primary-50));
        }

        .bg-primary-100 {
            background-color: rgb(var(--primary-100));
        }

        .bg-primary-500 {
            background-color: rgb(var(--primary-500));
        }

        .bg-primary-600 {
            background-color: rgb(var(--primary-600));
        }

        .bg-primary-700 {
            background-color: rgb(var(--primary-700));
        }

        .text-primary-600 {
            color: rgb(var(--primary-600));
        }

        .text-primary-700 {
            color: rgb(var(--primary-700));
        }

        .text-primary-800 {
            color: rgb(var(--primary-800));
        }

        .hover\:bg-primary-700:hover {
            background-color: rgb(var(--primary-700));
        }

        .hover\:text-primary-800:hover {
            color: rgb(var(--primary-800));
        }

        .border-primary-500 {
            border-color: rgb(var(--primary-500));
        }

        .ring-primary-500 {
            --tw-ring-color: rgb(var(--primary-500));
        }

        .focus\:ring-primary-500:focus {
            --tw-ring-color: rgb(var(--primary-500));
        }

        .focus\:border-primary-500:focus {
            border-color: rgb(var(--primary-500));
        }

        /* Secondary color applications */
        .bg-secondary-50 {
            background-color: rgb(var(--secondary-50));
        }

        .bg-secondary-100 {
            background-color: rgb(var(--secondary-100));
        }

        .bg-secondary-900 {
            background-color: rgb(var(--secondary-900));
        }

        .text-secondary-600 {
            color: rgb(var(--secondary-600));
        }

        .text-secondary-700 {
            color: rgb(var(--secondary-700));
        }

        /* Accent color applications */
        .bg-accent-500 {
            background-color: rgb(var(--accent-500));
        }

        .bg-accent-600 {
            background-color: rgb(var(--accent-600));
        }

        .text-accent-600 {
            color: rgb(var(--accent-600));
        }

        .hover\:bg-accent-700:hover {
            background-color: rgb(var(--accent-700));
        }
    </style>
</head>

<body class="antialiased font-sans bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <!-- Navigation -->
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

    <!-- Theme Customization Panel -->
    <div id="themePanel"
        class="fixed right-4 top-20 bg-white rounded-lg shadow-lg border p-4 z-50 w-80 transform translate-x-full transition-transform duration-300">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Theme Colors</h3>
            <button onclick="toggleThemePanel()" class="text-gray-400 hover:text-gray-600">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Primary Color -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Primary Color</label>
            <div class="flex items-center space-x-2">
                <input type="color" id="primaryColor" value="#3b82f6" class="w-12 h-8 rounded border border-gray-300">
                <span class="text-sm text-gray-600" id="primaryColorValue">#3b82f6</span>
            </div>
            <div class="mt-2 flex space-x-1">
                <button onclick="setPrimaryColor('#3b82f6')"
                    class="w-6 h-6 rounded bg-blue-500 border-2 border-gray-300"></button>
                <button onclick="setPrimaryColor('#ef4444')"
                    class="w-6 h-6 rounded bg-red-500 border-2 border-gray-300"></button>
                <button onclick="setPrimaryColor('#10b981')"
                    class="w-6 h-6 rounded bg-green-500 border-2 border-gray-300"></button>
                <button onclick="setPrimaryColor('#f59e0b')"
                    class="w-6 h-6 rounded bg-yellow-500 border-2 border-gray-300"></button>
                <button onclick="setPrimaryColor('#8b5cf6')"
                    class="w-6 h-6 rounded bg-purple-500 border-2 border-gray-300"></button>
                <button onclick="setPrimaryColor('#06b6d4')"
                    class="w-6 h-6 rounded bg-cyan-500 border-2 border-gray-300"></button>
            </div>
        </div>

        <!-- Secondary Color -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Secondary Color</label>
            <div class="flex items-center space-x-2">
                <input type="color" id="secondaryColor" value="#6b7280" class="w-12 h-8 rounded border border-gray-300">
                <span class="text-sm text-gray-600" id="secondaryColorValue">#6b7280</span>
            </div>
        </div>

        <!-- Accent Color -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Accent Color</label>
            <div class="flex items-center space-x-2">
                <input type="color" id="accentColor" value="#22c55e" class="w-12 h-8 rounded border border-gray-300">
                <span class="text-sm text-gray-600" id="accentColorValue">#22c55e</span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex space-x-2">
            <button onclick="resetTheme()"
                class="flex-1 px-4 py-2 text-sm bg-gray-100 text-gray-700 rounded hover:bg-gray-200 transition">
                Reset
            </button>
            <button onclick="saveTheme()"
                class="flex-1 px-4 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Save
            </button>
        </div>
    </div>

    <!-- Theme Toggle Button -->
    <button id="themeToggle" onclick="toggleThemePanel()"
        class="fixed right-4 top-24 bg-white rounded-full shadow-lg p-3 z-40 hover:bg-gray-50 transition-colors">
        <svg class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z" />
        </svg>
    </button>

    <!-- Hero Section -->
    <div class="relative overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-transparent sm:pb-16 md:pb-20 lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-bold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">Empower Your</span>
                            <span class="block text-primary-600 xl:inline">Financial Journey</span>
                        </h1>
                        <p
                            class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            The comprehensive mentoring and training platform designed specifically for your team.
                            Track progress, access AI-powered modules, and build your success with personalized
                            guidance.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                @guest
                                <a href="{{ route('register') }}"
                                    class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 md:py-4 md:text-lg md:px-10 transition duration-200">
                                    Join Now
                                </a>
                                @else
                                <a href="{{ route('dashboard') }}"
                                    class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 md:py-4 md:text-lg md:px-10 transition duration-200">
                                    Go to Dashboard
                                </a>
                                @endguest
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <button onclick="openVideoModal()"
                                    class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-red-600 hover:bg-red-700 md:py-4 md:text-lg md:px-10 transition duration-200">
                                    <svg class="mr-2 h-7 w-7" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z" />
                                    </svg>
                                    Watch Intro
                                </button>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <a href="#features"
                                    class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 md:py-4 md:text-lg md:px-10 transition duration-200">
                                    Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="features" class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">Features</h2>
                <p class="mt-2 text-3xl leading-8 font-bold tracking-tight text-gray-900 sm:text-4xl">
                    Everything you need to succeed
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                    Comprehensive tools and resources designed to accelerate your growth in the financial services
                    industry.
                </p>
            </div>

            <div class="mt-10">
                <div class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-x-8 md:gap-y-10">
                    <!-- Feature 1 -->
                    <div class="relative">
                        <div
                            class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.832 18.477 19.246 18 17.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Personalized Mentoring</p>
                        <p class="mt-2 ml-16 text-base text-gray-500">
                            Get paired with experienced mentors who provide guidance tailored to your goals and
                            progress.
                        </p>
                        <div class="ml-16 mt-4">
                            <button onclick="openFeatureModal('mentoring')"
                                class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center transition duration-200">
                                Read more
                                <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="relative">
                        <div
                            class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                        </div>
                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900">AI-Powered Modules</p>
                        <p class="mt-2 ml-16 text-base text-gray-500">
                            Access intelligent training modules that adapt to your learning style and track your
                            progress.
                        </p>
                        <div class="ml-16 mt-4">
                            <button onclick="openFeatureModal('ai-modules')"
                                class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center transition duration-200">
                                Read more
                                <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="relative">
                        <div
                            class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Progress Analytics</p>
                        <p class="mt-2 ml-16 text-base text-gray-500">
                            Visualize your growth with detailed analytics and performance tracking across all areas.
                        </p>
                        <div class="ml-16 mt-4">
                            <button onclick="openFeatureModal('analytics')"
                                class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center transition duration-200">
                                Read more
                                <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Feature 4 -->
                    <div class="relative">
                        <div
                            class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Team Collaboration</p>
                        <p class="mt-2 ml-16 text-base text-gray-500">
                            Connect with your team, share insights, and collaborate on goals within your hierarchy.
                        </p>
                        <div class="ml-16 mt-4">
                            <button onclick="openFeatureModal('collaboration')"
                                class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center transition duration-200">
                                Read more
                                <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Feature 5 -->
                    <div class="relative">
                        <div
                            class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Licensing Support</p>
                        <p class="mt-2 ml-16 text-base text-gray-500">
                            Get comprehensive support to obtain your financial licenses with study guides, practice
                            exams, and expert guidance.
                        </p>
                        <div class="ml-16 mt-4">
                            <button onclick="openFeatureModal('licensing')"
                                class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center transition duration-200">
                                Read more
                                <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Feature 6 -->
                    <div class="relative">
                        <div
                            class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Resource Center</p>
                        <p class="mt-2 ml-16 text-base text-gray-500">
                            Access a comprehensive library of training materials, presentations, scripts, and resources
                            designed to accelerate your success.
                        </p>
                        <div class="ml-16 mt-4">
                            <button onclick="openFeatureModal('resources')"
                                class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center transition duration-200">
                                Read more
                                <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-blue-600">
        <div class="max-w-2xl mx-auto text-center py-16 px-4 sm:py-20 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-white sm:text-4xl">
                <span class="block">Ready to get started?</span>
                <span class="block">Join EFGTrack today.</span>
            </h2>
            <p class="mt-4 text-lg leading-6 text-blue-200">
                Take the first step towards achieving your financial services career goals.
            </p>
            @guest
            <a href="{{ route('register') }}"
                class="mt-8 w-full inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-blue-50 sm:w-auto transition duration-200">
                Create Account
            </a>
            @else
            <a href="{{ route('dashboard') }}"
                class="mt-8 w-full inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-blue-50 sm:w-auto transition duration-200">
                View Dashboard
            </a>
            @endguest
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <!-- Company Info -->
                <div class="space-y-8 xl:col-span-1">
                    <div class="flex items-center">
                        <svg class="h-10 w-10 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z" />
                        </svg>
                        <span class="ml-3 text-2xl font-bold text-white">EFGTrack</span>
                    </div>
                    <p class="text-gray-300 text-base max-w-md">
                        Empowering financial services professionals with comprehensive team management, mentoring, and
                        growth tracking tools.
                    </p>
                    <div class="flex space-x-6">
                        <!-- Social Media Links -->
                        <a href="#" class="text-gray-400 hover:text-gray-300 transition-colors">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-300 transition-colors">
                            <span class="sr-only">LinkedIn</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-300 transition-colors">
                            <span class="sr-only">YouTube</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Footer Links -->
                <div class="mt-12 grid grid-cols-2 gap-8 xl:mt-0 xl:col-span-2">
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <!-- Product -->
                        <div>
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Platform</h3>
                            <ul class="mt-4 space-y-4">
                                <li>
                                    <a href="#features"
                                        class="text-base text-gray-300 hover:text-white transition-colors">
                                        Features
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('dashboard') }}"
                                        class="text-base text-gray-300 hover:text-white transition-colors">
                                        Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-base text-gray-300 hover:text-white transition-colors">
                                        Pricing
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-base text-gray-300 hover:text-white transition-colors">
                                        API Documentation
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- Resources -->
                        <div class="mt-12 md:mt-0">
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Resources</h3>
                            <ul class="mt-4 space-y-4">
                                <li>
                                    <a href="#" class="text-base text-gray-300 hover:text-white transition-colors">
                                        Help Center
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-base text-gray-300 hover:text-white transition-colors">
                                        User Guides
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-base text-gray-300 hover:text-white transition-colors">
                                        Blog
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-base text-gray-300 hover:text-white transition-colors">
                                        Webinars
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <!-- Support -->
                        <div>
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Support</h3>
                            <ul class="mt-4 space-y-4">
                                <li>
                                    <a href="{{ route('contact') }}"
                                        class="text-base text-gray-300 hover:text-white transition-colors">
                                        Contact Us
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-base text-gray-300 hover:text-white transition-colors">
                                        Technical Support
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-base text-gray-300 hover:text-white transition-colors">
                                        Status Page
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-base text-gray-300 hover:text-white transition-colors">
                                        Community Forum
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- Legal -->
                        <div class="mt-12 md:mt-0">
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Legal</h3>
                            <ul class="mt-4 space-y-4">
                                <li>
                                    <a href="{{ route('privacy-policy') }}"
                                        class="text-base text-gray-300 hover:text-white transition-colors">
                                        Privacy Policy
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('terms-of-service') }}"
                                        class="text-base text-gray-300 hover:text-white transition-colors">
                                        Terms of Service
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('cookie-policy') }}"
                                        class="text-base text-gray-300 hover:text-white transition-colors">
                                        Cookie Policy
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-base text-gray-300 hover:text-white transition-colors">
                                        Security
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Section -->
            <div class="mt-12 border-t border-gray-700 pt-8">
                <div class="md:flex md:items-center md:justify-between">
                    <div class="flex space-x-6 md:order-2">
                        <!-- Additional Links -->
                        <a href="#" class="text-gray-400 hover:text-gray-300 text-sm">
                            Accessibility
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-300 text-sm">
                            Security
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-300 text-sm">
                            Compliance
                        </a>
                    </div>
                    <p class="mt-8 text-base text-gray-400 md:mt-0 md:order-1">
                        © {{ date('Y') }} EFGTrack. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- YouTube Video Modal -->
    <div id="videoModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 flex items-center justify-center p-4"
        style="display: none;" onclick="closeVideoModal()">
        <!-- Modal Content -->
        <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-hidden"
            onclick="event.stopPropagation()">
            <!-- Modal Header -->
            <div class="flex justify-between items-center p-4 border-b">
                <h3 class="text-lg font-semibold text-gray-900">EFGTrack Introduction</h3>
                <button onclick="closeVideoModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Video Container -->
            <div class="relative" style="padding-bottom: 56.25%; height: 0;">
                <iframe id="videoFrame" class="absolute top-0 left-0 w-full h-full" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    </div>

    <!-- Feature Detail Modal -->
    <div id="featureModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 flex items-center justify-center p-4"
        style="display: none;" onclick="closeFeatureModal()">
        <!-- Modal Content -->
        <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto"
            onclick="event.stopPropagation()">
            <!-- Modal Header -->
            <div class="flex justify-between items-center p-6 border-b">
                <h3 id="featureModalTitle" class="text-2xl font-bold text-gray-900"></h3>
                <button onclick="closeFeatureModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <!-- Feature Description -->
                <div class="mb-8">
                    <p id="featureModalDescription" class="text-lg text-gray-700 leading-relaxed"></p>
                </div>

                <!-- Feature Benefits -->
                <div class="mb-8">
                    <h4 class="text-xl font-semibold text-gray-900 mb-4">Key Benefits</h4>
                    <ul id="featureModalBenefits" class="space-y-3"></ul>
                </div>

                <!-- Video Section -->
                <div class="mb-8">
                    <h4 class="text-xl font-semibold text-gray-900 mb-4">Learn More</h4>
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h5 class="font-medium text-gray-900 mb-2">Watch Tutorial Video</h5>
                                <p class="text-gray-600 text-sm">Get an in-depth explanation of this feature</p>
                            </div>
                            <button id="featureVideoButton"
                                class="flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200">
                                <svg class="mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z" />
                                </svg>
                                Watch Video
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Call to Action -->
                <div class="bg-blue-50 rounded-lg p-6">
                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Ready to get started?</h4>
                    <p class="text-gray-600 mb-4">Experience this feature and more by joining EFGTrack today.</p>
                    @guest
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition duration-200">
                        Create Account
                    </a>
                    @else
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition duration-200">
                        Go to Dashboard
                    </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>

    <!-- Go to Top Button -->
    <button id="goToTopBtn"
        class="fixed bottom-8 right-8 bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full shadow-lg transition-all duration-300 opacity-0 invisible z-50"
        onclick="scrollToTop()" title="Go to top">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
    </button>

    <script>
        function openVideoModal() {
            const modal = document.getElementById('videoModal');
            const iframe = document.getElementById('videoFrame');
            iframe.src = 'https://www.youtube.com/embed/u31qwQUeGuM?autoplay=1&rel=0';
            modal.style.display = 'flex';
        }

        function closeVideoModal() {
            const modal = document.getElementById('videoModal');
            const iframe = document.getElementById('videoFrame');
            iframe.src = '';
            modal.style.display = 'none';
        }

        // Feature modal data
        const featureData = {
            'mentoring': {
                title: 'Personalized Mentoring',
                description: 'Our personalized mentoring program connects you with experienced professionals in the financial services industry. Get one-on-one guidance tailored to your specific career goals, challenges, and aspirations.',
                benefits: [
                    'Matched with mentors based on your career goals and industry interests',
                    'Flexible scheduling to accommodate your busy lifestyle',
                    'Regular progress check-ins and goal-setting sessions',
                    'Access to exclusive industry insights and best practices',
                    'Networking opportunities within the EFGTrack community'
                ],
                videoUrl: 'https://www.youtube.com/embed/u31qwQUeGuM?autoplay=1&rel=0' // Same video as hero section
            },
            'ai-modules': {
                title: 'AI-Powered Learning Modules',
                description: 'Experience the future of professional development with our AI-driven learning platform. Our intelligent modules adapt to your learning style, pace, and preferences to maximize your growth potential.',
                benefits: [
                    'Personalized learning paths based on your strengths and weaknesses',
                    'Real-time progress tracking and performance analytics',
                    'Interactive simulations and real-world scenarios',
                    'Adaptive content that evolves with your skill level',
                    'Integration with industry-standard tools and platforms'
                ],
                videoUrl: 'https://www.youtube.com/embed/u31qwQUeGuM?autoplay=1&rel=0' // Same video as hero section
            },
            'analytics': {
                title: 'Progress Analytics',
                description: 'Transform your professional development with comprehensive analytics that provide deep insights into your growth trajectory. Track your progress, identify improvement areas, and celebrate your achievements.',
                benefits: [
                    'Detailed performance dashboards with visual reports',
                    'Goal tracking and milestone management',
                    'Comparative analysis against industry benchmarks',
                    'Predictive insights for future career opportunities',
                    'Exportable reports for performance reviews and career planning'
                ],
                videoUrl: 'https://www.youtube.com/embed/u31qwQUeGuM?autoplay=1&rel=0' // Same video as hero section
            },
            'collaboration': {
                title: 'Team Collaboration',
                description: 'Foster meaningful connections and drive collective success with our advanced collaboration tools. Work seamlessly with your team, share knowledge, and achieve goals together within your organizational hierarchy.',
                benefits: [
                    'Role-based access and hierarchical team management',
                    'Shared goal setting and progress tracking across teams',
                    'Knowledge sharing platform with best practices library',
                    'Real-time communication and feedback systems',
                    'Team performance analytics and insights'
                ],
                videoUrl: 'https://www.youtube.com/embed/u31qwQUeGuM?autoplay=1&rel=0' // Same video as hero section
            },
            'licensing': {
                title: 'Licensing Support',
                description: 'Navigate the complex world of financial licensing with confidence. Our comprehensive licensing support program provides you with everything needed to obtain and maintain your professional licenses in the financial services industry.',
                benefits: [
                    'Comprehensive study guides for Series 7, 66, 63, and other key licenses',
                    'Interactive practice exams with detailed explanations',
                    'Personalized study plans based on your timeline and goals',
                    'Expert tutoring sessions with licensed professionals',
                    'License maintenance and continuing education tracking',
                    'State-specific requirements and application assistance'
                ],
                videoUrl: 'https://www.youtube.com/embed/u31qwQUeGuM?autoplay=1&rel=0' // Same video as hero section
            },
            'resources': {
                title: 'Resource Center',
                description: 'Access our comprehensive digital library featuring thousands of professional-grade resources designed to accelerate your success in the financial services industry. Everything you need is organized and easily accessible in one centralized location.',
                benefits: [
                    'Professional sales scripts and conversation starters',
                    'PowerPoint presentations for client meetings and prospecting',
                    'Video training library with industry experts and top producers',
                    'Marketing materials and templates for social media and print',
                    'Industry reports, market analysis, and economic updates',
                    'Compliance-approved content and regulatory guidelines'
                ],
                videoUrl: 'https://www.youtube.com/embed/u31qwQUeGuM?autoplay=1&rel=0' // Same video as hero section
            }
        };

        function openFeatureModal(featureId) {
            const modal = document.getElementById('featureModal');
            const data = featureData[featureId];
            
            if (!data) return;
            
            // Update modal content
            document.getElementById('featureModalTitle').textContent = data.title;
            document.getElementById('featureModalDescription').textContent = data.description;
            
            // Update benefits list
            const benefitsList = document.getElementById('featureModalBenefits');
            benefitsList.innerHTML = '';
            data.benefits.forEach(benefit => {
                const li = document.createElement('li');
                li.className = 'flex items-start';
                li.innerHTML = `
                    <svg class="h-5 w-5 text-green-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-gray-700">${benefit}</span>
                `;
                benefitsList.appendChild(li);
            });
            
            // Update video button
            const videoButton = document.getElementById('featureVideoButton');
            videoButton.onclick = () => openFeatureVideo(data.videoUrl);
            
            // Show modal
            modal.style.display = 'flex';
        }

        function closeFeatureModal() {
            const modal = document.getElementById('featureModal');
            modal.style.display = 'none';
        }

        function openFeatureVideo(videoUrl) {
            // Close feature modal first
            closeFeatureModal();
            
            // Open video modal with the feature video
            const modal = document.getElementById('videoModal');
            const iframe = document.getElementById('videoFrame');
            const title = document.querySelector('#videoModal h3');
            
            // Update title for feature video
            title.textContent = 'Feature Tutorial Video';
            iframe.src = videoUrl;
            modal.style.display = 'flex';
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeVideoModal();
                closeFeatureModal();
            }
        });

        // Go to Top functionality
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Show/hide go to top button and enhance sticky navbar
        let lastScrollTop = 0;
        const navbar = document.querySelector('nav');
        const goToTopBtn = document.getElementById('goToTopBtn');
        
        window.addEventListener('scroll', function() {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            // Show/hide go to top button
            if (scrollTop > 300) {
                goToTopBtn.classList.remove('opacity-0', 'invisible');
                goToTopBtn.classList.add('opacity-100', 'visible');
            } else {
                goToTopBtn.classList.add('opacity-0', 'invisible');
                goToTopBtn.classList.remove('opacity-100', 'visible');
            }
            
            // Enhanced navbar behavior (optional shadow on scroll)
            if (scrollTop > 10) {
                navbar.classList.add('shadow-md');
                navbar.classList.remove('shadow-sm');
            } else {
                navbar.classList.remove('shadow-md');
                navbar.classList.add('shadow-sm');
            }
            
            lastScrollTop = scrollTop;
        });

        // Theme Management System
        let themeColors = {
            primary: '#3b82f6',
            secondary: '#6b7280', 
            accent: '#22c55e'
        };

        // Load saved theme on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadSavedTheme();
            initializeColorPickers();
        });

        function initializeColorPickers() {
            const primaryInput = document.getElementById('primaryColor');
            const secondaryInput = document.getElementById('secondaryColor');
            const accentInput = document.getElementById('accentColor');

            primaryInput.addEventListener('change', function(e) {
                updatePrimaryColor(e.target.value);
            });

            secondaryInput.addEventListener('change', function(e) {
                updateSecondaryColor(e.target.value);
            });

            accentInput.addEventListener('change', function(e) {
                updateAccentColor(e.target.value);
            });
        }

        function toggleThemePanel() {
            const panel = document.getElementById('themePanel');
            panel.classList.toggle('translate-x-full');
        }

        function hexToRgb(hex) {
            const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
            return result ? {
                r: parseInt(result[1], 16),
                g: parseInt(result[2], 16),
                b: parseInt(result[3], 16)
            } : null;
        }

        function generateColorShades(baseColor) {
            const rgb = hexToRgb(baseColor);
            if (!rgb) return {};
            
            const shades = {};
            const baseValues = [rgb.r, rgb.g, rgb.b];
            
            // Generate lighter shades (50-400)
            shades[50] = baseValues.map(v => Math.min(255, v + (255 - v) * 0.95)).join(' ');
            shades[100] = baseValues.map(v => Math.min(255, v + (255 - v) * 0.9)).join(' ');
            shades[200] = baseValues.map(v => Math.min(255, v + (255 - v) * 0.75)).join(' ');
            shades[300] = baseValues.map(v => Math.min(255, v + (255 - v) * 0.6)).join(' ');
            shades[400] = baseValues.map(v => Math.min(255, v + (255 - v) * 0.3)).join(' ');
            
            // Base color (500)
            shades[500] = baseValues.join(' ');
            
            // Generate darker shades (600-900)
            shades[600] = baseValues.map(v => Math.max(0, v * 0.8)).join(' ');
            shades[700] = baseValues.map(v => Math.max(0, v * 0.65)).join(' ');
            shades[800] = baseValues.map(v => Math.max(0, v * 0.5)).join(' ');
            shades[900] = baseValues.map(v => Math.max(0, v * 0.35)).join(' ');
            
            return shades;
        }

        function updatePrimaryColor(color) {
            themeColors.primary = color;
            const shades = generateColorShades(color);
            const root = document.documentElement;
            
            Object.keys(shades).forEach(shade => {
                root.style.setProperty(`--primary-${shade}`, shades[shade]);
            });
            
            document.getElementById('primaryColorValue').textContent = color;
            applyThemeToElements();
        }

        function updateSecondaryColor(color) {
            themeColors.secondary = color;
            const shades = generateColorShades(color);
            const root = document.documentElement;
            
            Object.keys(shades).forEach(shade => {
                root.style.setProperty(`--secondary-${shade}`, shades[shade]);
            });
            
            document.getElementById('secondaryColorValue').textContent = color;
        }

        function updateAccentColor(color) {
            themeColors.accent = color;
            const shades = generateColorShades(color);
            const root = document.documentElement;
            
            Object.keys(shades).forEach(shade => {
                root.style.setProperty(`--accent-${shade}`, shades[shade]);
            });
            
            document.getElementById('accentColorValue').textContent = color;
        }

        function setPrimaryColor(color) {
            document.getElementById('primaryColor').value = color;
            updatePrimaryColor(color);
        }

        function applyThemeToElements() {
            // Update elements that use hardcoded blue colors with primary colors
            const elementsToUpdate = document.querySelectorAll('.bg-blue-600, .text-blue-600, .hover\\:bg-blue-700');
            elementsToUpdate.forEach(el => {
                if (el.classList.contains('bg-blue-600')) {
                    el.classList.remove('bg-blue-600');
                    el.classList.add('bg-primary-600');
                }
                if (el.classList.contains('text-blue-600')) {
                    el.classList.remove('text-blue-600');
                    el.classList.add('text-primary-600');
                }
                if (el.classList.contains('hover:bg-blue-700')) {
                    el.classList.remove('hover:bg-blue-700');
                    el.classList.add('hover:bg-primary-700');
                }
            });
        }

        function saveTheme() {
            localStorage.setItem('efgtrack-theme', JSON.stringify(themeColors));
            
            // Show success message
            const button = event.target;
            const originalText = button.textContent;
            button.textContent = 'Saved!';
            button.classList.add('bg-green-600', 'hover:bg-green-700');
            button.classList.remove('bg-blue-600', 'hover:bg-blue-700');
            
            setTimeout(() => {
                button.textContent = originalText;
                button.classList.remove('bg-green-600', 'hover:bg-green-700');
                button.classList.add('bg-blue-600', 'hover:bg-blue-700');
            }, 2000);
        }

        function loadSavedTheme() {
            const savedTheme = localStorage.getItem('efgtrack-theme');
            if (savedTheme) {
                const theme = JSON.parse(savedTheme);
                themeColors = { ...themeColors, ...theme };
                
                // Apply saved colors
                document.getElementById('primaryColor').value = themeColors.primary;
                document.getElementById('secondaryColor').value = themeColors.secondary;
                document.getElementById('accentColor').value = themeColors.accent;
                
                updatePrimaryColor(themeColors.primary);
                updateSecondaryColor(themeColors.secondary);
                updateAccentColor(themeColors.accent);
            }
        }

        function resetTheme() {
            const defaultTheme = {
                primary: '#3b82f6',
                secondary: '#6b7280',
                accent: '#22c55e'
            };
            
            document.getElementById('primaryColor').value = defaultTheme.primary;
            document.getElementById('secondaryColor').value = defaultTheme.secondary;
            document.getElementById('accentColor').value = defaultTheme.accent;
            
            updatePrimaryColor(defaultTheme.primary);
            updateSecondaryColor(defaultTheme.secondary);
            updateAccentColor(defaultTheme.accent);
            
            themeColors = defaultTheme;
        }
    </script>
</body>

</html>