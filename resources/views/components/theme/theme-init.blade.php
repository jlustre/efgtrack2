<!-- Theme System Initialization -->
<script>
    // Initialize theme system when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing theme system...');
    console.log('Auth status:', {{ auth()->check() ? 'true' : 'false' }});
    
    @auth
    if (window.EFGTheme && window.EFGTheme.UI) {
        console.log('Initializing authenticated theme system');
        try {
            window.EFGTheme.UI.init();
        } catch (e) {
            console.warn('EFGTheme.UI.init failed, falling back to Utils/localStorage', e);
        }
    } else if (window.EFGTheme && window.EFGTheme.Utils) {
        // If UI object is not present but Utils exists, apply saved theme via Utils
        console.log('EFGTheme.UI not present; applying theme via Utils fallback');
        const savedTheme = localStorage.getItem('efgtrack-theme');
        if (savedTheme) {
            const theme = JSON.parse(savedTheme);
            Object.keys(theme).forEach(colorType => {
                window.EFGTheme.Utils.updateCSSVariables(colorType, theme[colorType]);
            });
            if (typeof window.EFGTheme.Utils.applyThemeToElements === 'function') {
                window.EFGTheme.Utils.applyThemeToElements();
            }
        }
    }
    @else
    if (window.EFGTheme && window.EFGTheme.Utils) {
        console.log('Initializing guest theme system');
        // For guests, just apply theme from localStorage if available
        const savedTheme = localStorage.getItem('efgtrack-theme');
        if (savedTheme) {
            const theme = JSON.parse(savedTheme);
            Object.keys(theme).forEach(colorType => {
                window.EFGTheme.Utils.updateCSSVariables(colorType, theme[colorType]);
            });
            window.EFGTheme.Utils.applyThemeToElements();
        }
    }
    @endauth
    
    // Debug information
    setTimeout(() => {
        const button = document.getElementById('theme-selector-toggle');
        const selector = document.getElementById('theme-selector');
        console.log('Theme elements final check:', {
            button: button,
            selector: selector,
            buttonVisible: button ? window.getComputedStyle(button).display : 'not found',
            selectorVisible: selector ? window.getComputedStyle(selector).display : 'not found'
        });
    }, 1000);
});
</script>