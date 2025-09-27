{{--
Landing Page Features Section Component
Contains the main features grid with interactive elements
--}}
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
                    <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
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
                    <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
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
                    <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
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
                    <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
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
                    <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
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
                        </button>
                    </div>
                </div>

                <!-- Feature 6 -->
                <div class="relative">
                    <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
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