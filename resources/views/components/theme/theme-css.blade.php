<!-- Dynamic Theme CSS Variables -->
<style id="dynamic-theme">
    :root {
        /* Primary Colors */
        --primary-50: 239 246 255;
        --primary-100: 219 234 254;
        --primary-200: 191 219 254;
        --primary-300: 147 197 253;
        --primary-400: 96 165 250;
        --primary-500: 59 130 246;
        --primary-600: 37 99 235;
        --primary-700: 29 78 216;
        --primary-800: 30 64 175;
        --primary-900: 30 58 138;

        /* Secondary Colors */
        --secondary-50: 249 250 251;
        --secondary-100: 243 244 246;
        --secondary-200: 229 231 235;
        --secondary-300: 209 213 219;
        --secondary-400: 156 163 175;
        --secondary-500: 107 114 128;
        --secondary-600: 75 85 99;
        --secondary-700: 55 65 81;
        --secondary-800: 31 41 55;
        --secondary-900: 17 24 39;

        /* Accent Colors */
        --accent-50: 240 253 244;
        --accent-100: 220 252 231;
        --accent-200: 187 247 208;
        --accent-300: 134 239 172;
        --accent-400: 74 222 128;
        --accent-500: 34 197 94;
        --accent-600: 22 163 74;
        --accent-700: 21 128 61;
        --accent-800: 22 101 52;
        --accent-900: 20 83 45;
    }

    /* Dynamic color applications */
    .bg-primary-50 {
        background-color: rgb(var(--primary-50));
    }

    .bg-primary-100 {
        background-color: rgb(var(--primary-100));
    }

    .bg-primary-500 {
        background-color: rgb(var(--primary-500));
    }

    .bg-primary-600 {
        background-color: rgb(var(--primary-600));
    }

    .bg-primary-700 {
        background-color: rgb(var(--primary-700));
    }

    .text-primary-600 {
        color: rgb(var(--primary-600));
    }

    .text-primary-700 {
        color: rgb(var(--primary-700));
    }

    .text-primary-900 {
        color: rgb(var(--primary-900));
    }

    .hover\:bg-primary-700:hover {
        background-color: rgb(var(--primary-700));
    }

    .hover\:bg-primary-600:hover {
        background-color: rgb(var(--primary-600));
    }

    .border-primary-500 {
        border-color: rgb(var(--primary-500));
    }

    .ring-primary-500 {
        --tw-ring-color: rgb(var(--primary-500));
    }

    .focus\:ring-primary-500:focus {
        --tw-ring-color: rgb(var(--primary-500));
    }

    .focus\:border-primary-500:focus {
        border-color: rgb(var(--primary-500));
    }

    /* Secondary Colors */
    .bg-secondary-50 {
        background-color: rgb(var(--secondary-50));
    }

    .bg-secondary-100 {
        background-color: rgb(var(--secondary-100));
    }

    .bg-secondary-900 {
        background-color: rgb(var(--secondary-900));
    }

    .text-secondary-600 {
        color: rgb(var(--secondary-600));
    }

    .text-secondary-700 {
        color: rgb(var(--secondary-700));
    }

    /* Accent Colors */
    .bg-accent-500 {
        background-color: rgb(var(--accent-500));
    }

    .bg-accent-600 {
        background-color: rgb(var(--accent-600));
    }

    .text-accent-600 {
        color: rgb(var(--accent-600));
    }

    .hover\:bg-accent-700:hover {
        background-color: rgb(var(--accent-700));
    }

    /* Additional theme-aware classes */
    .gradient-primary {
        background: linear-gradient(135deg, rgb(var(--primary-600)), rgb(var(--primary-800)));
    }

    .gradient-primary-light {
        background: linear-gradient(135deg, rgb(var(--primary-50)), rgb(var(--primary-100)));
    }
</style>