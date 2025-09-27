<!-- Theme API Integration -->
<script>
    window.EFGTheme = window.EFGTheme || {};

// API integration for authenticated users
@auth
window.EFGTheme.API = {
    async loadTheme() {
        try {
            const response = await fetch('/api/theme', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            
            if (response.ok) {
                const data = await response.json();
                return data.theme_settings;
            }
            throw new Error('Failed to load theme');
        } catch (error) {
            console.error('API theme load failed:', error);
            // Fallback to localStorage
            const savedTheme = localStorage.getItem('efgtrack-theme');
            return savedTheme ? JSON.parse(savedTheme) : null;
        }
    },

    async saveTheme(colors) {
        try {
            const response = await fetch('/api/theme', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(colors)
            });
            
            if (!response.ok) {
                throw new Error('Failed to save theme');
            }
            
            // Also save to localStorage as backup
            localStorage.setItem('efgtrack-theme', JSON.stringify(colors));
            
        } catch (error) {
            console.error('API theme save failed:', error);
            // Fallback to localStorage
            localStorage.setItem('efgtrack-theme', JSON.stringify(colors));
        }
    }
};
@else
// Guest users - localStorage only
window.EFGTheme.API = {
    async loadTheme() {
        const savedTheme = localStorage.getItem('efgtrack-theme');
        return savedTheme ? JSON.parse(savedTheme) : null;
    },

    async saveTheme(colors) {
        localStorage.setItem('efgtrack-theme', JSON.stringify(colors));
    }
};
@endauth
</script>