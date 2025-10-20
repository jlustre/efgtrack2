<div id="avatar-upload-modal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-40">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative">
            <button onclick="document.getElementById('avatar-upload-modal').classList.add('hidden')"
                class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <h3 class="text-lg font-semibold mb-4">{{ __('Update Profile Picture') }}</h3>
            @livewire('profile.avatar-upload')
        </div>
    </div>