{{--
Landing Page Theme System JavaScript Component
Contains all theme management functionality (standalone version for landing page)
--}}
<script>
    // Theme Management System
    let themeColors = {
        primary: '#3b82f6',
        secondary: '#6b7280', 
        accent: '#22c55e'
    };

    // Load saved theme on page load
    document.addEventListener('DOMContentLoaded', function() {
        loadSavedTheme();
        initializeColorPickers();
    });

    function initializeColorPickers() {
        const primaryInput = document.getElementById('primaryColor');
        const secondaryInput = document.getElementById('secondaryColor');
        const accentInput = document.getElementById('accentColor');

        if (primaryInput) {
            primaryInput.addEventListener('change', function(e) {
                updatePrimaryColor(e.target.value);
            });
        }

        if (secondaryInput) {
            secondaryInput.addEventListener('change', function(e) {
                updateSecondaryColor(e.target.value);
            });
        }

        if (accentInput) {
            accentInput.addEventListener('change', function(e) {
                updateAccentColor(e.target.value);
            });
        }
    }

    function toggleThemePanel() {
        const panel = document.getElementById('themePanel');
        if (panel) {
            panel.classList.toggle('translate-x-full');
        }
    }

    function hexToRgb(hex) {
        const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
        return result ? {
            r: parseInt(result[1], 16),
            g: parseInt(result[2], 16),
            b: parseInt(result[3], 16)
        } : null;
    }

    function generateColorShades(baseColor) {
        const rgb = hexToRgb(baseColor);
        if (!rgb) return {};
        
        const shades = {};
        const baseValues = [rgb.r, rgb.g, rgb.b];
        
        // Generate lighter shades (50-400)
        shades[50] = baseValues.map(v => Math.min(255, v + (255 - v) * 0.95)).join(' ');
        shades[100] = baseValues.map(v => Math.min(255, v + (255 - v) * 0.9)).join(' ');
        shades[200] = baseValues.map(v => Math.min(255, v + (255 - v) * 0.75)).join(' ');
        shades[300] = baseValues.map(v => Math.min(255, v + (255 - v) * 0.6)).join(' ');
        shades[400] = baseValues.map(v => Math.min(255, v + (255 - v) * 0.3)).join(' ');
        
        // Base color (500)
        shades[500] = baseValues.join(' ');
        
        // Generate darker shades (600-900)
        shades[600] = baseValues.map(v => Math.max(0, v * 0.8)).join(' ');
        shades[700] = baseValues.map(v => Math.max(0, v * 0.65)).join(' ');
        shades[800] = baseValues.map(v => Math.max(0, v * 0.5)).join(' ');
        shades[900] = baseValues.map(v => Math.max(0, v * 0.35)).join(' ');
        
        return shades;
    }

    function updatePrimaryColor(color) {
        themeColors.primary = color;
        const shades = generateColorShades(color);
        const root = document.documentElement;
        
        Object.keys(shades).forEach(shade => {
            root.style.setProperty(`--primary-${shade}`, shades[shade]);
        });
        
        const colorValueElement = document.getElementById('primaryColorValue');
        if (colorValueElement) {
            colorValueElement.textContent = color;
        }
        applyThemeToElements();
    }

    function updateSecondaryColor(color) {
        themeColors.secondary = color;
        const shades = generateColorShades(color);
        const root = document.documentElement;
        
        Object.keys(shades).forEach(shade => {
            root.style.setProperty(`--secondary-${shade}`, shades[shade]);
        });
        
        const colorValueElement = document.getElementById('secondaryColorValue');
        if (colorValueElement) {
            colorValueElement.textContent = color;
        }
    }

    function updateAccentColor(color) {
        themeColors.accent = color;
        const shades = generateColorShades(color);
        const root = document.documentElement;
        
        Object.keys(shades).forEach(shade => {
            root.style.setProperty(`--accent-${shade}`, shades[shade]);
        });
        
        const colorValueElement = document.getElementById('accentColorValue');
        if (colorValueElement) {
            colorValueElement.textContent = color;
        }
    }

    function setPrimaryColor(color) {
        const primaryInput = document.getElementById('primaryColor');
        if (primaryInput) {
            primaryInput.value = color;
        }
        updatePrimaryColor(color);
    }

    function applyThemeToElements() {
        // Update elements that use hardcoded blue colors with primary colors
        const elementsToUpdate = document.querySelectorAll('.bg-blue-600, .text-blue-600, .hover\\:bg-blue-700');
        elementsToUpdate.forEach(el => {
            if (el.classList.contains('bg-blue-600')) {
                el.classList.remove('bg-blue-600');
                el.classList.add('bg-primary-600');
            }
            if (el.classList.contains('text-blue-600')) {
                el.classList.remove('text-blue-600');
                el.classList.add('text-primary-600');
            }
            if (el.classList.contains('hover:bg-blue-700')) {
                el.classList.remove('hover:bg-blue-700');
                el.classList.add('hover:bg-primary-700');
            }
        });
    }

    function saveTheme() {
        localStorage.setItem('efgtrack-theme', JSON.stringify(themeColors));
        
        // Show success message
        const button = event.target;
        const originalText = button.textContent;
        button.textContent = 'Saved!';
        button.classList.add('bg-green-600', 'hover:bg-green-700');
        button.classList.remove('bg-blue-600', 'hover:bg-blue-700');
        
        setTimeout(() => {
            button.textContent = originalText;
            button.classList.remove('bg-green-600', 'hover:bg-green-700');
            button.classList.add('bg-blue-600', 'hover:bg-blue-700');
        }, 2000);
    }

    function loadSavedTheme() {
        const savedTheme = localStorage.getItem('efgtrack-theme');
        if (savedTheme) {
            const theme = JSON.parse(savedTheme);
            themeColors = { ...themeColors, ...theme };
            
            // Apply saved colors
            const primaryInput = document.getElementById('primaryColor');
            const secondaryInput = document.getElementById('secondaryColor');
            const accentInput = document.getElementById('accentColor');
            
            if (primaryInput) primaryInput.value = themeColors.primary;
            if (secondaryInput) secondaryInput.value = themeColors.secondary;
            if (accentInput) accentInput.value = themeColors.accent;
            
            updatePrimaryColor(themeColors.primary);
            updateSecondaryColor(themeColors.secondary);
            updateAccentColor(themeColors.accent);
        }
    }

    function resetTheme() {
        const defaultTheme = {
            primary: '#3b82f6',
            secondary: '#6b7280',
            accent: '#22c55e'
        };
        
        const primaryInput = document.getElementById('primaryColor');
        const secondaryInput = document.getElementById('secondaryColor');
        const accentInput = document.getElementById('accentColor');
        
        if (primaryInput) primaryInput.value = defaultTheme.primary;
        if (secondaryInput) secondaryInput.value = defaultTheme.secondary;
        if (accentInput) accentInput.value = defaultTheme.accent;
        
        updatePrimaryColor(defaultTheme.primary);
        updateSecondaryColor(defaultTheme.secondary);
        updateAccentColor(defaultTheme.accent);
        
        themeColors = defaultTheme;
    }
</script>