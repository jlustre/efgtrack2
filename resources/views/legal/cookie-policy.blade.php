<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cookie Policy - EFGTrack</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Theme System -->
    @include('components.theme-system')
</head>

<body class="antialiased font-sans bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('landing') }}" class="flex items-center">
                            <svg class="h-8 w-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z" />
                            </svg>
                            <span class="ml-2 text-xl font-bold text-gray-900">EFGTrack</span>
                        </a>
                    </div>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('landing') }}"
                        class="text-blue-600 hover:text-blue-800 px-3 py-2 rounded-md text-sm font-medium">← Back to
                        Home</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-sm p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Cookie Policy</h1>
            <p class="text-sm text-gray-500 mb-8">Last updated: {{ date('F j, Y') }}</p>

            <div class="prose prose-blue max-w-none">
                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">What Are Cookies</h2>
                <p class="text-gray-700 mb-6">
                    Cookies are small text files that are placed on your computer or mobile device when you visit our
                    website. They are widely used to make websites work more efficiently and to provide information to
                    website owners.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">How We Use Cookies</h2>
                <p class="text-gray-700 mb-4">EFGTrack uses cookies for several purposes:</p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li><strong>Essential Cookies:</strong> Required for basic website functionality and security</li>
                    <li><strong>Authentication Cookies:</strong> Keep you logged in and secure your session</li>
                    <li><strong>Preference Cookies:</strong> Remember your settings and preferences</li>
                    <li><strong>Analytics Cookies:</strong> Help us understand how you use our platform</li>
                    <li><strong>Performance Cookies:</strong> Monitor and improve our service performance</li>
                </ul>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">Types of Cookies We Use</h2>

                <h3 class="text-lg font-semibold text-gray-800 mt-6 mb-3">Strictly Necessary Cookies</h3>
                <p class="text-gray-700 mb-4">These cookies are essential for our website to function properly. They
                    include:</p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li>Session management and user authentication</li>
                    <li>Security features and CSRF protection</li>
                    <li>Load balancing and server routing</li>
                    <li>Form submission and data validation</li>
                </ul>

                <h3 class="text-lg font-semibold text-gray-800 mt-6 mb-3">Functional Cookies</h3>
                <p class="text-gray-700 mb-4">These cookies enhance your experience by remembering your preferences:</p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li>Language and region preferences</li>
                    <li>Dashboard layout and customization settings</li>
                    <li>Theme preferences (dark/light mode)</li>
                    <li>Recently viewed content and bookmarks</li>
                </ul>

                <h3 class="text-lg font-semibold text-gray-800 mt-6 mb-3">Analytics Cookies</h3>
                <p class="text-gray-700 mb-4">We use these cookies to understand how our platform is used:</p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li>Page views and user journey tracking</li>
                    <li>Feature usage and interaction patterns</li>
                    <li>Performance metrics and error monitoring</li>
                    <li>A/B testing and platform optimization</li>
                </ul>

                <h3 class="text-lg font-semibold text-gray-800 mt-6 mb-3">Third-Party Cookies</h3>
                <p class="text-gray-700 mb-4">Some cookies are set by third-party services we use:</p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li><strong>YouTube:</strong> For embedded video content</li>
                    <li><strong>Google Analytics:</strong> For website analytics (if applicable)</li>
                    <li><strong>Content Delivery Networks:</strong> For faster content delivery</li>
                </ul>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">Cookie Duration</h2>
                <p class="text-gray-700 mb-4">We use both session and persistent cookies:</p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li><strong>Session Cookies:</strong> Deleted when you close your browser</li>
                    <li><strong>Persistent Cookies:</strong> Remain on your device for a specified period (typically
                        1-24 months)</li>
                    <li><strong>Secure Cookies:</strong> Only transmitted over encrypted HTTPS connections</li>
                </ul>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">Managing Your Cookie Preferences</h2>
                <p class="text-gray-700 mb-4">You have several options for managing cookies:</p>

                <h3 class="text-lg font-semibold text-gray-800 mt-6 mb-3">Browser Settings</h3>
                <p class="text-gray-700 mb-4">Most browsers allow you to:</p>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li>View and delete cookies</li>
                    <li>Block cookies from specific websites</li>
                    <li>Block third-party cookies</li>
                    <li>Clear all cookies when you close the browser</li>
                    <li>Set up warnings when cookies are being set</li>
                </ul>

                <h3 class="text-lg font-semibold text-gray-800 mt-6 mb-3">Platform Settings</h3>
                <p class="text-gray-700 mb-6">
                    You can manage your cookie preferences through your EFGTrack account settings. Navigate to Settings
                    > Privacy to adjust your preferences for non-essential cookies.
                </p>

                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                    <div class="flex">
                        <svg class="h-5 w-5 text-yellow-400 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        <div>
                            <h4 class="text-sm font-semibold text-yellow-800">Important Note</h4>
                            <p class="text-sm text-yellow-700 mt-1">
                                Disabling certain cookies may affect the functionality of our platform. Essential
                                cookies cannot be disabled as they are required for basic operation.
                            </p>
                        </div>
                    </div>
                </div>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">Updates to This Cookie Policy</h2>
                <p class="text-gray-700 mb-6">
                    We may update this Cookie Policy from time to time to reflect changes in our practices or for legal
                    reasons. We will notify you of any significant changes by posting the new policy on this page.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">Contact Us</h2>
                <p class="text-gray-700 mb-6">
                    If you have questions about our use of cookies, please contact us at:
                </p>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-gray-700"><strong>Email:</strong> privacy@efgtrack.com</p>
                    <p class="text-gray-700"><strong>Subject:</strong> Cookie Policy Inquiry</p>
                    <p class="text-gray-700"><strong>Address:</strong> EFGTrack Privacy Team</p>
                    <p class="text-gray-700">123 Business Ave, Suite 100</p>
                    <p class="text-gray-700">Financial District, NY 10001</p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-sm text-gray-500">
                © {{ date('Y') }} EFGTrack. All rights reserved.
            </p>
        </div>
    </footer>
</body>

</html>