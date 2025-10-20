<script>
    // Listen for Livewire events to update the flash message (profile-updated, error-notification, etc.)
    (function () {
        function dispatchFlash(detail) {
            const evt = new CustomEvent('flash-message', { detail });
            document.dispatchEvent(evt);
        }

        if (window.Livewire) {
            window.Livewire.on('profile-updated', (name) => {
                dispatchFlash({ type: 'success', message: 'Profile updated.' });
            });
            window.Livewire.on('profile-error', (msg) => {
                dispatchFlash({ type: 'error', message: msg || 'An error occurred.' });
            });
        }

        // Also listen for the Livewire browser event fallback (dispatchBrowserEvent)
        document.addEventListener('profile-updated', function (e) {
            const name = e && e.detail && e.detail.name ? e.detail.name : null;
            dispatchFlash({ type: 'success', message: 'Profile updated.' });
        });

        // If a flash-message event is dispatched, inject content into the flash root and show it.
        document.addEventListener('flash-message', (e) => {
            const detail = e.detail || {};
            const wrapper = document.querySelector('[data-flash-root]');
            if (!wrapper) return;
            wrapper.innerHTML = '';
            const div = document.createElement('div');
            div.innerHTML = `
                <div x-data="{ show: true }" x-show="show" x-transition class="mb-4">
                    <div class="rounded-md p-4 border ${detail.type === 'error' ? 'bg-red-50 border-red-300 text-red-800' : 'bg-green-50 border-green-300 text-green-800'} shadow-sm">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${detail.type === 'error' ? 'M18 8.25V6a2 2 0 00-2-2h-8a2 2 0 00-2 2v2.25M6 13.5v3.75A2.25 2.25 0 008.25 19.5h7.5A2.25 2.25 0 0018 17.25V13.5M9 9h6' : 'M5 13l4 4L19 7'}"/></svg>
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-sm font-medium">${detail.message || ''}</p>
                            </div>
                            <div class="ml-4 flex-shrink-0 flex items-start">
                                <button onclick="this.closest('[x-data]').__x.$data.show = false" class="inline-flex text-gray-500 hover:text-gray-700 focus:outline-none">
                                    <span class="sr-only">Dismiss</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            wrapper.appendChild(div.firstElementChild);

            // small auto-hide after 4s
            setTimeout(() => {
                const el = wrapper.querySelector('[x-data]');
                if (el && el.__x) el.__x.$data.show = false;
            }, 4000);
        });
    })();
</script>