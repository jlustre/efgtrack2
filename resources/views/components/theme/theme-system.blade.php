{{--
Theme System Component

A modular, reusable theme management system with database persistence.
Provides dynamic color customization for authenticated users.

Features:
- Real-time color picker interface
- Database storage with localStorage fallback
- Dynamic CSS variable generation
- Cross-session persistence

Usage: @include('components.theme.theme-system')
--}}

@include('components.theme.theme-selector-ui')
@include('components.theme.theme-css')
@include('components.theme.theme-utils')
@include('components.theme.theme-api')
@include('components.theme.theme-ui')
@include('components.theme.theme-init')