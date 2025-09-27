{{--
Modular Landing Page - Main Includer

This file includes all landing page components in the correct order.
Components are organized into logical sections for better maintainability.

Structure:
- Header (HTML head, meta tags, CSS)
- Navigation
- Hero section
- Features section
- Footer
- Modals
- UI elements (go-to-top button)
- JavaScript functionality
- Theme system (includes theme selector panel)
- Closing tags
--}}

{{-- HTML Head and CSS --}}
@include('components.landing.header')

{{-- Navigation Bar --}}
@include('components.landing.navigation')

{{-- Theme System UI (includes theme panel and toggle button) --}}
@include('components.theme.theme-system')

{{-- Hero Section --}}
@include('components.landing.hero')

{{-- Features Section with CTA --}}
@include('components.landing.features')

{{-- Footer --}}
@include('components.landing.footer')

{{-- Modals --}}
@include('components.landing.video-modal')
@include('components.landing.feature-modal')

{{-- UI Elements --}}
@include('components.landing.go-to-top')

{{-- JavaScript Components --}}
@include('components.landing.js.video-functions')
@include('components.landing.js.feature-modal')
@include('components.landing.js.navigation')
@include('components.landing.js.theme-system')

</body>

</html>

</html>