<!-- Theme JavaScript Core Functions -->
<script>
    // Theme Management Core
window.EFGTheme = window.EFGTheme || {};

// Core utility functions
window.EFGTheme.Utils = {
    hexToRgb(hex) {
        const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
        return result ? {
            r: parseInt(result[1], 16),
            g: parseInt(result[2], 16),
            b: parseInt(result[3], 16)
        } : null;
    },

    generateColorShades(baseColor) {
        const rgb = this.hexToRgb(baseColor);
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
    },

    applyThemeToElements() {
        // Convert existing hardcoded blue colors to primary colors
        const colorMappings = [
            { from: 'bg-blue-600', to: 'bg-primary-600' },
            { from: 'bg-blue-700', to: 'bg-primary-700' },
            { from: 'bg-blue-500', to: 'bg-primary-500' },
            { from: 'text-blue-600', to: 'text-primary-600' },
            { from: 'text-blue-700', to: 'text-primary-700' },
            { from: 'hover:bg-blue-700', to: 'hover:bg-primary-700' },
            { from: 'hover:bg-blue-600', to: 'hover:bg-primary-600' },
            { from: 'border-blue-500', to: 'border-primary-500' },
            { from: 'ring-blue-500', to: 'ring-primary-500' },
            { from: 'focus:ring-blue-500', to: 'focus:ring-primary-500' },
            { from: 'focus:border-blue-500', to: 'focus:border-primary-500' }
        ];

        colorMappings.forEach(mapping => {
            const elements = document.querySelectorAll(`.${mapping.from}`);
            elements.forEach(el => {
                el.classList.remove(mapping.from);
                el.classList.add(mapping.to);
            });
        });
    },

    updateCSSVariables(colorType, color) {
        const shades = this.generateColorShades(color);
        const root = document.documentElement;
        
        Object.keys(shades).forEach(shade => {
            root.style.setProperty(`--${colorType}-${shade}`, shades[shade]);
        });
    },

    updateToggleButtonColor(button, color) {
        if (button) {
            button.style.backgroundColor = color;
        }
    }
};
</script>