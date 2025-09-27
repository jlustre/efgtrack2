{{--
Theme Selector UI Component - Enhanced Version
Contains the improved theme customization panel with save functionality
--}}
@auth
<!-- Theme Customization Panel -->
<div id="themePanel"
    class="fixed right-4 top-20 bg-white rounded-lg shadow-lg border p-4 z-50 w-80 transform translate-x-full transition-transform duration-300 opacity-0"
    style="transform: translateX(100%); visibility: hidden;">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-900">Theme Colors</h3>
        <button onclick="toggleThemePanel()" class="text-gray-400 hover:text-gray-600">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Primary Color -->
    <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-2">Primary Color</label>
        <div class="flex items-center space-x-2">
            <input type="color" id="primaryColor" value="#3b82f6" class="w-12 h-8 rounded border border-gray-300">
            <span class="text-sm text-gray-600" id="primaryColorValue">#3b82f6</span>
        </div>
        <div class="mt-2 flex space-x-1">
            <button onclick="setPrimaryColor('#3b82f6')"
                class="w-6 h-6 rounded bg-blue-500 border-2 border-gray-300"></button>
            <button onclick="setPrimaryColor('#ef4444')"
                class="w-6 h-6 rounded bg-red-500 border-2 border-gray-300"></button>
            <button onclick="setPrimaryColor('#10b981')"
                class="w-6 h-6 rounded bg-green-500 border-2 border-gray-300"></button>
            <button onclick="setPrimaryColor('#f59e0b')"
                class="w-6 h-6 rounded bg-yellow-500 border-2 border-gray-300"></button>
            <button onclick="setPrimaryColor('#8b5cf6')"
                class="w-6 h-6 rounded bg-purple-500 border-2 border-gray-300"></button>
            <button onclick="setPrimaryColor('#06b6d4')"
                class="w-6 h-6 rounded bg-cyan-500 border-2 border-gray-300"></button>
        </div>
    </div>

    <!-- Secondary Color -->
    <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-2">Secondary Color</label>
        <div class="flex items-center space-x-2">
            <input type="color" id="secondaryColor" value="#6b7280" class="w-12 h-8 rounded border border-gray-300">
            <span class="text-sm text-gray-600" id="secondaryColorValue">#6b7280</span>
        </div>
    </div>

    <!-- Accent Color -->
    <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-2">Accent Color</label>
        <div class="flex items-center space-x-2">
            <input type="color" id="accentColor" value="#22c55e" class="w-12 h-8 rounded border border-gray-300">
            <span class="text-sm text-gray-600" id="accentColorValue">#22c55e</span>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex space-x-2">
        <button onclick="resetTheme()"
            class="flex-1 px-4 py-2 text-sm bg-gray-100 text-gray-700 rounded hover:bg-gray-200 transition">
            Reset
        </button>
        <button onclick="saveTheme()"
            class="flex-1 px-4 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            Save
        </button>
    </div>
</div>

<!-- Theme Toggle Button -->
<button id="themeToggle" onclick="toggleThemePanel()"
    class="fixed right-4 top-24 bg-white rounded-full shadow-lg p-3 z-40 hover:bg-gray-50 transition-colors">
    <svg class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z" />
    </svg>
</button>
@endauth