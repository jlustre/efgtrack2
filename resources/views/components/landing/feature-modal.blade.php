{{--
Landing Page Feature Detail Modal Component
Contains the feature detail modal with benefits and video
--}}
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
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