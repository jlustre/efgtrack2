<!-- Footer -->
<footer class="bg-white border-t border-gray-200 mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Brand -->
            <div class="md:col-span-1">
                <div class="flex items-center mb-4">
                    <svg class="h-8 w-8 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z" />
                    </svg>
                    <span class="ml-3 text-2xl font-bold text-gray-900">EFGTrack</span>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Professional team management portal for financial services organizations.
                </p>
            </div>

            <!-- Product Links -->
            <div>
                <h3 class="font-semibold text-gray-900 mb-4">Product</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('landing') }}"
                            class="text-gray-600 hover:text-gray-900 text-sm transition-colors">Home</a></li>
                    <li><a href="{{ route('register') }}"
                            class="text-gray-600 hover:text-gray-900 text-sm transition-colors">Get Started</a></li>
                    <li><a href="{{ route('login') }}"
                            class="text-gray-600 hover:text-gray-900 text-sm transition-colors">Sign In</a></li>
                    <li><a href="{{ route('contact') }}"
                            class="text-gray-600 hover:text-gray-900 text-sm transition-colors">Contact</a></li>
                </ul>
            </div>

            <!-- Legal Links -->
            <div>
                <h3 class="font-semibold text-gray-900 mb-4">Legal</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('privacy-policy') }}"
                            class="text-gray-600 hover:text-gray-900 text-sm transition-colors">Privacy Policy</a></li>
                    <li><a href="{{ route('terms-of-service') }}"
                            class="text-gray-600 hover:text-gray-900 text-sm transition-colors">Terms of Service</a>
                    </li>
                    <li><a href="{{ route('cookie-policy') }}"
                            class="text-gray-600 hover:text-gray-900 text-sm transition-colors">Cookie Policy</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h3 class="font-semibold text-gray-900 mb-4">Support</h3>
                <ul class="space-y-3">
                    <li><a href="mailto:support@efgtrack.com"
                            class="text-gray-600 hover:text-gray-900 text-sm transition-colors">Email Support</a></li>
                    <li><a href="mailto:technical@efgtrack.com"
                            class="text-gray-600 hover:text-gray-900 text-sm transition-colors">Technical Help</a></li>
                    <li><a href="mailto:sales@efgtrack.com"
                            class="text-gray-600 hover:text-gray-900 text-sm transition-colors">Sales Inquiries</a></li>
                </ul>
            </div>
        </div>

        <!-- Bottom Footer -->
        <div class="border-t border-gray-200 mt-8 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-500 text-sm">
                    © {{ date('Y') }} EFGTrack. All rights reserved.
                </p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="{{ route('privacy-policy') }}"
                        class="text-gray-500 hover:text-gray-900 text-sm transition-colors">Privacy</a>
                    <a href="{{ route('terms-of-service') }}"
                        class="text-gray-500 hover:text-gray-900 text-sm transition-colors">Terms</a>
                    <a href="{{ route('contact') }}"
                        class="text-gray-500 hover:text-gray-900 text-sm transition-colors">Contact</a>
                </div>
            </div>
        </div>
    </div>
</footer>