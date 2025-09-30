<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component
{
    public string $name = '';
    public string $email = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Personal Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
        <!-- Profile Picture Preview -->
        @if($this->user->avatar_url)
        <div class="flex items-center space-x-4">
            <img class="h-16 w-16 rounded-full object-cover" src="{{ $this->user->avatar_url }}"
                alt="{{ $this->user->display_name }}">
            <div>
                <div class="text-sm font-medium text-gray-900">{{ $this->user->display_name }}</div>
                <div class="text-sm text-gray-500">Current profile picture</div>
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Username -->
            <div>
                <x-input-label for="username" :value="__('Username')" />
                <x-text-input wire:model="username" id="username" name="username" type="text" class="mt-1 block w-full"
                    autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('username')" />
                <p class="mt-1 text-xs text-gray-500">Your unique username (e.g., @{{ $username ?: 'yourusername' }})
                </p>
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
                <p class="mt-1 text-xs text-gray-500">How you'd like to be addressed in the system</p>
            </div>
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full" required
                autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($this->user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $this->user->hasVerifiedEmail())
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

        <!-- Contact Information -->
        <div class="border-t border-gray-200 pt-6">
            <h3 class="text-base font-medium text-gray-900 mb-4">Contact Information</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Phone -->
                <div>
                    <x-input-label for="phone" :value="__('Phone Number')" />
                    <x-text-input wire:model="phone" id="phone" name="phone" type="tel" class="mt-1 block w-full"
                        autocomplete="tel" />
                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                </div>

                <!-- Emergency Contact -->
                <div>
                    <x-input-label for="emergency_contact" :value="__('Emergency Contact')" />
                    <x-text-input wire:model="emergency_contact" id="emergency_contact" name="emergency_contact"
                        type="text" class="mt-1 block w-full" />
                    <x-input-error class="mt-2" :messages="$errors->get('emergency_contact')" />
                    <p class="mt-1 text-xs text-gray-500">Name and phone number</p>
                </div>
            </div>
        </div>

        <!-- Location Information -->
        <div class="border-t border-gray-200 pt-6">
            <h3 class="text-base font-medium text-gray-900 mb-4">Location</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- City -->
                <div>
                    <x-input-label for="city" :value="__('City')" />
                    <x-text-input wire:model="city" id="city" name="city" type="text" class="mt-1 block w-full"
                        autocomplete="address-level2" />
                    <x-input-error class="mt-2" :messages="$errors->get('city')" />
                </div>

                <!-- Province/State -->
                <div>
                    <x-input-label for="province_state" :value="__('Province/State')" />
                    <x-text-input wire:model="province_state" id="province_state" name="province_state" type="text"
                        class="mt-1 block w-full" autocomplete="address-level1" />
                    <x-input-error class="mt-2" :messages="$errors->get('province_state')" />
                </div>

                <!-- Country -->
                <div>
                    <x-input-label for="country" :value="__('Country')" />
                    <select wire:model="country" id="country" name="country"
                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <option value="">Select Country</option>
                        <option value="CA">Canada</option>
                        <option value="US">United States</option>
                        <option value="GB">United Kingdom</option>
                        <option value="AU">Australia</option>
                        <option value="DE">Germany</option>
                        <option value="FR">France</option>
                        <option value="JP">Japan</option>
                        <!-- Add more countries as needed -->
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('country')" />
                </div>
            </div>
        </div>

        <!-- Preferences -->
        <div class="border-t border-gray-200 pt-6">
            <h3 class="text-base font-medium text-gray-900 mb-4">Preferences</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Timezone -->
                <div>
                    <x-input-label for="timezone" :value="__('Timezone')" />
                    <select wire:model="timezone" id="timezone" name="timezone"
                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <option value="">Select Timezone</option>
                        <option value="America/Toronto">Eastern Time (Toronto)</option>
                        <option value="America/Vancouver">Pacific Time (Vancouver)</option>
                        <option value="America/New_York">Eastern Time (New York)</option>
                        <option value="America/Los_Angeles">Pacific Time (Los Angeles)</option>
                        <option value="Europe/London">GMT (London)</option>
                        <option value="Europe/Paris">CET (Paris)</option>
                        <option value="Asia/Tokyo">JST (Tokyo)</option>
                        <option value="Australia/Sydney">AEST (Sydney)</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('timezone')" />
                </div>

                <!-- Preferred Contact Method -->
                <div>
                    <x-input-label for="preferred_contact_method" :value="__('Preferred Contact Method')" />
                    <select wire:model="preferred_contact_method" id="preferred_contact_method"
                        name="preferred_contact_method"
                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <option value="email">Email</option>
                        <option value="phone">Phone</option>
                        <option value="both">Both Email and Phone</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('preferred_contact_method')" />
                </div>
            </div>

            <!-- Communication Preferences -->
            <div class="mt-6">
                <fieldset>
                    <legend class="text-sm font-medium text-gray-900">Communication Preferences</legend>
                    <div class="mt-2 space-y-3">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input wire:model="email_notifications" id="email_notifications"
                                    name="email_notifications" type="checkbox"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="email_notifications" class="font-medium text-gray-700">Email
                                    Notifications</label>
                                <p class="text-gray-500">Receive updates about recruits, mentorships, and system
                                    notifications via email.</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input wire:model="sms_notifications" id="sms_notifications" name="sms_notifications"
                                    type="checkbox"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="sms_notifications" class="font-medium text-gray-700">SMS
                                    Notifications</label>
                                <p class="text-gray-500">Receive urgent notifications via SMS (requires phone number).
                                </p>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>

        <!-- Membership Information (Read-only) -->
        @if($this->user->sponsor_id || $this->user->member_since)
        <div class="border-t border-gray-200 pt-6">
            <h3 class="text-base font-medium text-gray-900 mb-4">Membership Information</h3>

            <div class="bg-gray-50 p-4 rounded-lg">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-3 sm:grid-cols-2">
                    @if($this->user->sponsor)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Sponsored by</dt>
                        <dd class="text-sm text-gray-900">{{ $this->user->sponsor->display_name }} (@{{
                            $this->user->sponsor->username }})</dd>
                    </div>
                    @endif

                    @if($this->user->member_since)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Member Since</dt>
                        <dd class="text-sm text-gray-900">{{ $this->user->member_since->format('F j, Y') }}</dd>
                    </div>
                    @endif

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Member Status</dt>
                        <dd class="text-sm">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $this->user->member_status_color }}-100 text-{{ $this->user->member_status_color }}-800">
                                {{ $this->user->member_status_label }}
                            </span>
                        </dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Profile Completion</dt>
                        <dd class="text-sm text-gray-900">
                            {{ $this->user->isProfileComplete() ? 'Complete' : 'Incomplete' }}
                            ({{ $this->user->isProfileComplete() ? 100 : 60 }}%)
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
            <x-primary-button>{{ __('Save Changes') }}</x-primary-button>

            <x-action-message class="me-3" on="profile-updated">
                {{ __('Saved.') }}
            </x-action-message>
        </div>
    </form>
</section>