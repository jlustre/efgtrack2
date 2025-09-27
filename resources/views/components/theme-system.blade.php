{{--
Legacy Theme System - Redirects to Modular Components

This file provides backward compatibility for existing layouts
that still reference 'components.theme-system'

The actual theme system has been moved to:
- components/theme/theme-system.blade.php (main includer)
- components/theme/theme-*.blade.php (individual components)
--}}
@include('components.theme.theme-system')