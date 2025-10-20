<!-- Controller logic removed. This file is now view-only as requested. -->

<section>
    @php $profileUser = $user ?? auth()->user(); @endphp
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Personal Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form wire:submit.prevent="updateProfileInformation" class="mt-6 space-y-6 drag-scroll"
        style="max-height: 600px; overflow-y: auto;">
        <!-- Error Message (inside form, above first input) -->
        @include('components.form-error-alert')
        <!-- Profile Picture Preview -->
        <div class="flex items-center space-x-4">
            <div class="relative">
                <img class="h-16 w-16 rounded-full object-cover"
                    src="{{ asset('storage/avatars/' . ($profileUser->avatar_path ?? 'default.png')) }}"
                    alt="{{ $profileUser->display_name }}">
                <button onclick="document.getElementById('avatar-upload-modal').classList.remove('hidden')"
                    class="absolute -bottom-1 -right-1 bg-teal-200 border border-gray-300 rounded-full p-1 shadow hover:bg-teal-100 focus:outline-none">
                    <svg class="h-4 w-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.232 5.232l3.536 3.536M9 13l6.293-6.293a1 1 0 011.414 0l3.586 3.586a1 1 0 010 1.414L13 17H9v-4z" />
                    </svg>
                </button>
            </div>
            <div>
                <div class="text-sm font-medium text-gray-900">{{ $profileUser->display_name }}</div>
                <div class="text-sm text-gray-500">{{ __('Current profile picture') }}</div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Username -->
            <div>
                <x-input-label for="username" :value="__('Username')" />
                <input wire:model.lazy="username" id="username" name="username" type="text"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    {{ $readonly }}>
                <x-input-error class="mt-2" :messages="$errors->get('username')" />
                @unless($isAdmin)
                <p class="mt-1 text-xs text-gray-500">{{ __('This can only be changed by an admin.') }}</p>
                @endunless
            </div>

            <!-- Sponsor -->
            <div>
                <x-input-label for="sponsor" :value="__('Sponsor')" />
                <input type="hidden" wire:model="sponsor_id" name="sponsor_id" id="sponsor_id" />
                <input type="text" value="{{ optional($profileUser->sponsor)->username }}"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    {{ $readonly }} />
                <x-input-error class="mt-2" :messages="$errors->get('sponsor_id')" />
                @unless($isAdmin)
                <p class="mt-1 text-xs text-gray-500">{{ __('This can only be changed by an admin.') }}</p>
                @endunless
            </div>

            <!-- First Name -->
            <div>
                <x-input-label for="first_name" :value="__('First Name')" />
                <x-text-input wire:model="first_name" id="first_name" name="first_name" type="text"
                    class="mt-1 block w-full" autocomplete="given-name" />
                <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
            </div>

            <!-- Last Name -->
            <div>
                <x-input-label for="last_name" :value="__('Last Name')" />
                <x-text-input wire:model="last_name" id="last_name" name="last_name" type="text"
                    class="mt-1 block w-full" autocomplete="family-name" />
                <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
            </div>

            <!-- Display Name (System Name) -->
            <div>
                <x-input-label for="name" :value="__('Display Name')" />
                <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full" required
                    autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                <p class="mt-1 text-xs text-gray-500">{{ __('How you\'d like to be addressed in the system') }}</p>
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full" required
                    autocomplete="email" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($profileUser instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !
                $profileUser->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button wire:click.prevent="sendVerification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                    @endif
                </div>
                @endif
            </div>

            <!-- Phone -->
            <div>
                <x-input-label for="phone" :value="__('Phone Number')" />
                <x-text-input wire:model="phone" id="phone" name="phone" type="tel" class="mt-1 block w-full"
                    autocomplete="tel" />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>

            <!-- Best Contact Times -->
            <div>
                <x-input-label for="best_contact_times" :value="__('Best Contact Times (Based on timezone)')" />
                <select wire:model="best_contact_times" id="best_contact_times" name="best_contact_times"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="">{{ __('Select a time block') }}</option>
                    @include('components.best-contact-times-options')
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('best_contact_times')" />
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
            <x-primary-button>{{ __('Save Changes') }}</x-primary-button>

            <!-- Inline Alpine fallback in case browser events don't reach the action-message -->
            <div x-data="{ show: @entangle('showSuccess') }" x-show="show" x-transition x-cloak
                class="text-sm text-green-600 font-medium">
                {{ __('Personal Info Saved.') }}
            </div>
        </div>
    </form>
    <script>
        // Drag-to-scroll for vertical scrolling
            document.addEventListener('DOMContentLoaded', function() {
                const el = document.querySelector('.drag-scroll');
                if (!el) return;
                let isDown = false;
                let startY;
                let scrollTop;
                el.addEventListener('mousedown', function(e) {
                    isDown = true;
                    el.classList.add('scrolling');
                    startY = e.pageY - el.offsetTop;
                    scrollTop = el.scrollTop;
                });
                document.addEventListener('mouseup', function() {
                    isDown = false;
                    el.classList.remove('scrolling');
                });
                el.addEventListener('mouseleave', function() {
                    isDown = false;
                    el.classList.remove('scrolling');
                });
                el.addEventListener('mousemove', function(e) {
                    if (!isDown) return;
                    e.preventDefault();
                    const y = e.pageY - el.offsetTop;
                    const walk = (y - startY);
                    el.scrollTop = scrollTop - walk;
                });
            });
    </script>
</section>