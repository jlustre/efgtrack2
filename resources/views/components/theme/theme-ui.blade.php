{{--
Theme UI Controller Component
Contains all the UI interaction functions for the enhanced theme system
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
        initializeThemePanel();
        loadSavedTheme();
        initializeColorPickers();
    });

    function initializeThemePanel() {
        const panel = document.getElementById('themePanel');
        if (panel) {
            // Ensure panel starts completely hidden
            panel.style.visibility = 'hidden';
            panel.style.transform = 'translateX(100%)';
            panel.classList.add('translate-x-full', 'opacity-0');
        }
    }

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
            const isHidden = panel.classList.contains('translate-x-full');
            
            if (isHidden) {
                // Show panel
                panel.style.visibility = 'visible';
                panel.classList.remove('opacity-0');
                panel.classList.remove('translate-x-full');
                panel.style.transform = 'translateX(0)';
            } else {
                // Hide panel
                panel.classList.add('translate-x-full');
                panel.classList.add('opacity-0');
                panel.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    panel.style.visibility = 'hidden';
                }, 300); // Wait for transition to complete
            }
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

    @auth
    async function saveTheme() {
        const button = document.querySelector('button[onclick="saveTheme()"]');
        const originalText = button.textContent;
        
        // Show loading state
        button.textContent = 'Saving...';
        button.disabled = true;
        
        try {
            const response = await fetch('/api/theme', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(themeColors)
            });

            const data = await response.json();

            if (response.ok) {
                // Also save to localStorage as backup
                localStorage.setItem('efgtrack-theme', JSON.stringify(themeColors));
                
                // Show success message
                showNotification('Theme saved successfully!', 'success');
                button.textContent = 'Saved!';
                button.classList.add('bg-green-600', 'hover:bg-green-700');
                button.classList.remove('bg-blue-600', 'hover:bg-blue-700');
                
                setTimeout(() => {
                    button.textContent = originalText;
                    button.classList.remove('bg-green-600', 'hover:bg-green-700');
                    button.classList.add('bg-blue-600', 'hover:bg-blue-700');
                    button.disabled = false;
                }, 2000);
            } else {
                throw new Error(data.message || data.error || 'Failed to save theme');
            }
        } catch (error) {
            console.error('Error saving theme:', error);
            
            // Save to localStorage as fallback
            localStorage.setItem('efgtrack-theme', JSON.stringify(themeColors));
            
            // Show error message
            showNotification(error.message || 'Failed to save to database. Saved locally instead.', 'error');
            
            // Reset button
            button.textContent = originalText;
            button.disabled = false;
        }
    }

    async function loadSavedTheme() {
        try {
            // For authenticated users, try to load from database first
            const response = await fetch('/api/theme');
            if (response.ok) {
                const data = await response.json();
                const savedTheme = data.theme_settings;
                if (savedTheme && Object.keys(savedTheme).length > 0) {
                    themeColors = { ...themeColors, ...savedTheme };
                    applyLoadedTheme();
                    return;
                }
            }
        } catch (error) {
            console.log('Database theme load failed, trying localStorage');
        }

        // Fallback to localStorage
        const savedTheme = localStorage.getItem('efgtrack-theme');
        if (savedTheme) {
            const theme = JSON.parse(savedTheme);
            themeColors = { ...themeColors, ...theme };
            applyLoadedTheme();
        }
    }
    @else
    function saveTheme() {
        localStorage.setItem('efgtrack-theme', JSON.stringify(themeColors));
        
        // Show success message
        showNotification('Theme saved locally!', 'success');
        
        const button = document.querySelector('button[onclick="saveTheme()"]');
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
            applyLoadedTheme();
        }
    }
    @endauth

    function applyLoadedTheme() {
        // Apply saved colors to inputs
        const primaryInput = document.getElementById('primaryColor');
        const secondaryInput = document.getElementById('secondaryColor');
        const accentInput = document.getElementById('accentColor');
        
        if (primaryInput) primaryInput.value = themeColors.primary;
        if (secondaryInput) secondaryInput.value = themeColors.secondary;
        if (accentInput) accentInput.value = themeColors.accent;
        
        // Apply colors to CSS variables
        updatePrimaryColor(themeColors.primary);
        updateSecondaryColor(themeColors.secondary);
        updateAccentColor(themeColors.accent);
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
        
        showNotification('Theme reset to default values', 'info');
    }

    // Notification system
    function showNotification(message, type = 'info') {
        // Remove existing notifications
        const existing = document.getElementById('themeNotification');
        if (existing) {
            existing.remove();
        }

        // Create notification element
        const notification = document.createElement('div');
        notification.id = 'themeNotification';
        notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg border max-w-sm transition-all duration-300 transform translate-x-full`;
        
        // Set colors based on type
        let bgColor, textColor, borderColor, icon;
        switch (type) {
            case 'success':
                bgColor = 'bg-green-50';
                textColor = 'text-green-800';
                borderColor = 'border-green-200';
                icon = '✓';
                break;
            case 'error':
                bgColor = 'bg-red-50';
                textColor = 'text-red-800';
                borderColor = 'border-red-200';
                icon = '✕';
                break;
            case 'info':
                bgColor = 'bg-blue-50';
                textColor = 'text-blue-800';
                borderColor = 'border-blue-200';
                icon = 'ℹ';
                break;
            default:
                bgColor = 'bg-gray-50';
                textColor = 'text-gray-800';
                borderColor = 'border-gray-200';
                icon = '•';
        }
        
        notification.classList.add(bgColor, textColor, borderColor);
        notification.innerHTML = `
            <div class="flex items-center">
                <span class="text-lg mr-2 font-bold">${icon}</span>
                <span class="text-sm font-medium">${message}</span>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-auto text-gray-400 hover:text-gray-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        `;

        // Add to DOM
        document.body.appendChild(notification);
        
        // Slide in
        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 100);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            if (notification.parentElement) {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    if (notification.parentElement) {
                        notification.remove();
                    }
                }, 300);
            }
        }, 5000);
    }
</script>

<script>
    // Expose a simple UI object expected by theme-init
    window.EFGTheme = window.EFGTheme || {};
    // Provide a minimal UI surface so other scripts can call .init()
    window.EFGTheme.UI = window.EFGTheme.UI || {
        init: function() {
            try {
                // Call the existing functions defined above to initialize the UI
                if (typeof initializeThemePanel === 'function') initializeThemePanel();
                if (typeof loadSavedTheme === 'function') loadSavedTheme();
                if (typeof initializeColorPickers === 'function') initializeColorPickers();
            } catch (e) {
                console.error('EFGTheme.UI.init error', e);
            }
        }
    };
</script>