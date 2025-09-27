<!-- Theme System Initialization -->
<script>
    // Initialize theme system when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing theme system...');
    console.log('Auth status:', {{ auth()->check() ? 'true' : 'false' }});
    
    @auth
    if (window.EFGTheme && window.EFGTheme.UI) {
        console.log('Initializing authenticated theme system');
        window.EFGTheme.UI.init();
    } else {
        console.error('EFGTheme.UI not found');
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