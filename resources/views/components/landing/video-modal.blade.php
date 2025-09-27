{{--
Landing Page Video Modal Component
Contains the YouTube video player modal
--}}
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
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