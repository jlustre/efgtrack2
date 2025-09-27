{{--
Landing Page Go To Top Button Component
Contains the floating scroll-to-top button
--}}
<button id="goToTopBtn"
    class="fixed bottom-8 right-8 bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full shadow-lg transition-all duration-300 opacity-0 invisible z-50"
    onclick="scrollToTop()" title="Go to top">
    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
    </svg>
</button>