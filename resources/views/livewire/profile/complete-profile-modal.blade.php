<div>
    @if ($success)
    <div class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-xl shadow-lg">
        <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg relative flex items-center justify-between"
            role="alert">
            <div class="flex items-center gap-3">
                <span class="text-2xl font-bold">✔️</span>
                <div>
                    <strong class="font-bold">{{ __('Profile Saved!') }}</strong>
                    <span class="block sm:inline ml-2">{{ __('Your profile is :percent% complete.', ['percent' =>
                        $percent]) }}</span>
                </div>
            </div>
            <div class="flex gap-3">
                <button type="button" wire:click="hideSuccessMessage"
                    class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition">{{ __('Close')
                    }}</button>
                <button type="button" wire:click="continueFillingUp"
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">{{ __('Continue
                    Filling Up') }}</button>
            </div>
            <button type="button" wire:click="hideSuccessMessage"
                class="absolute top-2 right-3 text-xl text-green-700 hover:text-green-900">&times;</button>
        </div>
    </div>
    @endif
    @if($show && !$success)
    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl p-6 relative max-h-screen overflow-y-auto">
            <button type="button" wire:click="closeModal"
                class="absolute top-0 right-0 mt-2 mr-6 text-gray-400 hover:text-gray-600 text-2xl font-bold focus:outline-none">&times;</button>
            <h2 class="text-xl font-bold mb-4">{{ __('Complete Your Profile') }}</h2>
            <div class="mb-4">
                <div class="w-full bg-gray-200 rounded-full h-4 mb-2">
                    <div class="bg-blue-600 h-4 rounded-full" style="width: {{ $percent }}%"></div>
                </div>
                <div class="text-right text-sm text-gray-600">{{ $percent }}% completed</div>
            </div>
            <form wire:submit.prevent="save" class="space-y-6">
                @if ($errors->any())
                <div class="mb-4">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error:</strong>
                        <span class="block sm:inline">Please fix the errors below and try again.</span>
                        <strong class="font-bold">{{ __('Error:') }}</strong>
                        <span class="block sm:inline">{{ __('Please fix the errors below and try again.') }}</span>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">{{ __('Sponsor') }}</label>
                        <input type="text" value="{{ $sponsor_username }}" readonly
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100" />
                        <input type="hidden" wire:model="form.sponsor_id" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">{{ __('Username') }}</label>
                        <input type="text" wire:model="form.username" readonly
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                        <input type="text" wire:model="form.name" readonly
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100" />
                        @error('form.name')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                        <input type="email" wire:model="form.email" readonly
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100" />
                        @error('form.email')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">{{ __('First Name') }}</label>
                        <input type="text" wire:model.lazy="form.first_name"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        @error('form.first_name')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">{{ __('Last Name') }}</label>
                        <input type="text" wire:model.lazy="form.last_name"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        @error('form.last_name')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                    <div class="flex items-end gap-4">
                        <div class="flex flex-col flex-1">
                            <label class="block text-sm font-medium text-gray-700">{{ __('Avatar') }}</label>
                            <input type="file" wire:model="form.avatar_path" accept="image/*"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                            @error('form.avatar_path')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                        </div>
                        <div class="flex items-center justify-center h-16 w-16">
                            @if (!empty($form['avatar_path']) && is_object($form['avatar_path']))
                            <img src="{{ $form['avatar_path']->temporaryUrl() }}" alt="Avatar Preview"
                                class="h-16 w-16 rounded-full object-cover border" />
                            @elseif (!empty($user->avatar_path))
                            <img src="{{ asset('storage/avatars/' . $user->avatar_path) }}" alt="Avatar Preview"
                                class="h-16 w-16 rounded-full object-cover border" />
                            @endif
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">{{ __('Country') }}</label>
                        <select wire:model="form.country_id" wire:change="updateStatesForCountry"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                            <option value="">Select a country</option>
                            @foreach(($countries ?? $activeCountries ?? []) as $country)
                            <option value="{{ (int) $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('form.country_id')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">{{ __('State/Province') }}</label>
                        <select wire:model="form.state_id" wire:key="states-{{ $form['country_id'] }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                            <option value="">Select a state/province</option>
                            @foreach(($states ?? []) as $state)
                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                        </select>
                        @error('form.state_id')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">{{ __('City') }}</label>
                        <input type="text" wire:model="form.city"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        @error('form.city')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">{{ __('Postal Code') }}</label>
                        <input type="text" wire:model="form.postal_code"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        @error('form.postal_code')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">{{ __('Phone') }}</label>
                        <input type="text" wire:model="form.phone"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        @error('form.phone')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">{{ __('Best Contact Times') }}</label>
                        <select wire:model="form.best_contact_times"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">Select a time block</option>
                            @include('components.best-contact-times-options')
                        </select>
                        @error('form.best_contact_times')<span class="text-red-500 text-xs">{{ $message
                            }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">{{ __('Timezone') }}</label>
                        <select wire:model="form.timezone"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                            <option value="">Select a timezone</option>
                            @foreach($timezones as $tz)
                            <option value="{{ $tz->name }}">
                                {{ $tz->name }}
                                @if($tz->abbreviation) ({{ $tz->abbreviation }}) @endif
                                @if($tz->utc_offset) [UTC{{ $tz->utc_offset }}] @endif
                            </option>
                            @endforeach
                        </select>
                        @error('form.timezone')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                    <div>
                        <label class="block text-sm font-medium text-gray-700">{{ __('Licensed') }} <span
                                class="text-gray-500 text-xs">{{ __('(Life, health or both)') }}</span></label>
                        <select wire:model="form.is_licensed"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                            <option value="">Select</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        @error('form.is_licensed')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white rounded hover:bg-blue-700">{{
                        __('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>