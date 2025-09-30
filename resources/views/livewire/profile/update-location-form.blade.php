<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Location & Contact') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Update your location information and timezone preferences.') }}
        </p>
    </header>

    <form wire:submit="updateLocation" class="mt-6 space-y-6">

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
                    <option value="CN">China</option>
                    <option value="IN">India</option>
                    <option value="BR">Brazil</option>
                    <option value="MX">Mexico</option>
                    <option value="ES">Spain</option>
                    <option value="IT">Italy</option>
                    <option value="NL">Netherlands</option>
                    <option value="SE">Sweden</option>
                    <option value="NO">Norway</option>
                    <option value="DK">Denmark</option>
                    <option value="FI">Finland</option>
                    <option value="CH">Switzerland</option>
                    <option value="AT">Austria</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('country')" />
            </div>
        </div>

        <!-- Timezone -->
        <div>
            <x-input-label for="timezone" :value="__('Timezone')" />
            <select wire:model="timezone" id="timezone" name="timezone"
                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="">Select Timezone</option>

                <!-- North America -->
                <optgroup label="North America">
                    <option value="America/St_Johns">Newfoundland Time (NST/NDT)</option>
                    <option value="America/Halifax">Atlantic Time (AST/ADT)</option>
                    <option value="America/Toronto">Eastern Time (EST/EDT)</option>
                    <option value="America/Winnipeg">Central Time (CST/CDT)</option>
                    <option value="America/Edmonton">Mountain Time (MST/MDT)</option>
                    <option value="America/Vancouver">Pacific Time (PST/PDT)</option>
                    <option value="America/Anchorage">Alaska Time (AKST/AKDT)</option>
                    <option value="Pacific/Honolulu">Hawaii Time (HST)</option>
                </optgroup>

                <!-- Europe -->
                <optgroup label="Europe">
                    <option value="Europe/London">GMT/BST (London)</option>
                    <option value="Europe/Paris">CET/CEST (Paris)</option>
                    <option value="Europe/Berlin">CET/CEST (Berlin)</option>
                    <option value="Europe/Rome">CET/CEST (Rome)</option>
                    <option value="Europe/Madrid">CET/CEST (Madrid)</option>
                    <option value="Europe/Amsterdam">CET/CEST (Amsterdam)</option>
                    <option value="Europe/Stockholm">CET/CEST (Stockholm)</option>
                    <option value="Europe/Moscow">MSK (Moscow)</option>
                </optgroup>

                <!-- Asia Pacific -->
                <optgroup label="Asia Pacific">
                    <option value="Asia/Tokyo">JST (Tokyo)</option>
                    <option value="Asia/Seoul">KST (Seoul)</option>
                    <option value="Asia/Shanghai">CST (Shanghai)</option>
                    <option value="Asia/Hong_Kong">HKT (Hong Kong)</option>
                    <option value="Asia/Singapore">SGT (Singapore)</option>
                    <option value="Asia/Kolkata">IST (Mumbai)</option>
                    <option value="Asia/Dubai">GST (Dubai)</option>
                    <option value="Australia/Sydney">AEST/AEDT (Sydney)</option>
                    <option value="Australia/Melbourne">AEST/AEDT (Melbourne)</option>
                    <option value="Australia/Perth">AWST (Perth)</option>
                    <option value="Pacific/Auckland">NZST/NZDT (Auckland)</option>
                </optgroup>

                <!-- Other -->
                <optgroup label="Other">
                    <option value="America/Sao_Paulo">BRT/BRST (São Paulo)</option>
                    <option value="America/Mexico_City">CST/CDT (Mexico City)</option>
                    <option value="Africa/Cairo">EET (Cairo)</option>
                    <option value="Africa/Johannesburg">SAST (Johannesburg)</option>
                </optgroup>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('timezone')" />
            <p class="mt-1 text-xs text-gray-500">This helps us show times in your local timezone</p>
        </div>

        @if($city || $province_state || $country)
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex">
                <svg class="h-5 w-5 text-blue-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <div>
                    <h4 class="text-sm font-medium text-blue-800">Current Location</h4>
                    <p class="text-sm text-blue-700 mt-1">
                        {{ collect([$city, $province_state, $country])->filter()->implode(', ') }}
                    </p>
                </div>
            </div>
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
            <x-primary-button>{{ __('Update Location') }}</x-primary-button>

            <x-action-message class="me-3" on="location-updated">
                {{ __('Location updated successfully.') }}
            </x-action-message>
        </div>
    </form>
</section>