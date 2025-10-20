@extends('layouts.app')

@section('content')
<div class="flex">
    <div class="w-64">
        @include('components.dashboard-sidebar', ['user' => Auth::user()])
    </div>
    <div class="flex-1 container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">{{ __('Edit User') }}</h1>
        @if($errors->any())
        <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('users.update', $user) }}" method="POST"
            class="max-w-2xl mx-auto bg-white p-6 rounded shadow" x-data="{ tab: 'personal' }">
            @csrf
            @method('PUT')
            <div class="mb-6 border-b">
                <nav class="flex gap-4">
                    <button type="button" :class="tab === 'personal' ? 'font-bold border-b-2 border-blue-500' : ''"
                        @click="tab = 'personal'">{{ __('Personal Info') }}</button>
                    <button type="button" :class="tab === 'business' ? 'font-bold border-b-2 border-blue-500' : ''"
                        @click="tab = 'business'">{{ __('Business Info') }}</button>
                    <button type="button" :class="tab === 'location' ? 'font-bold border-b-2 border-blue-500' : ''"
                        @click="tab = 'location'">{{ __('Location Info') }}</button>
                    <button type="button" :class="tab === 'password' ? 'font-bold border-b-2 border-blue-500' : ''"
                        @click="tab = 'password'">{{ __('Password Reset') }}</button>
                    <button type="button" :class="tab === 'other' ? 'font-bold border-b-2 border-blue-500' : ''"
                        @click="tab = 'other'">{{ __('Others') }}</button>
                </nav>
            </div>
            <div x-show="tab === 'personal'" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="username" class="block text-gray-700">{{ __('Username') }}</label>
                    <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}"
                        class="w-full border px-3 py-2 rounded">
                </div>
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">{{ __('Name') }}</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                        class="w-full border px-3 py-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="first_name" class="block text-gray-700">{{ __('First Name') }}</label>
                    <input type="text" name="first_name" id="first_name"
                        value="{{ old('first_name', $user->first_name) }}" class="w-full border px-3 py-2 rounded">
                </div>
                <div class="mb-4">
                    <label for="last_name" class="block text-gray-700">{{ __('Last Name') }}</label>
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->last_name) }}"
                        class="w-full border px-3 py-2 rounded">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700">{{ __('Email') }}</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                        class="w-full border px-3 py-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-gray-700">{{ __('Phone') }}</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                        class="w-full border px-3 py-2 rounded">
                </div>
                <div class="mb-4">
                    <label for="avatar_path" class="block text-gray-700">{{ __('Avatar Filename') }}</label>
                    <input type="text" name="avatar_path" id="avatar_path"
                        value="{{ old('avatar_path', $user->avatar_path) }}" class="w-full border px-3 py-2 rounded">
                </div>
            </div>
            <div x-show="tab === 'business'" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="is_licensed" class="block text-gray-700">{{ __('Licensed') }}</label>
                    <select name="is_licensed" id="is_licensed" class="w-full border px-3 py-2 rounded">
                        <option value="1" @if($user->is_licensed == 1) selected @endif>{{ __('Yes') }}</option>
                        <option value="0" @if($user->is_licensed == 0) selected @endif>{{ __('No') }}</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="sponsor_id" class="block text-gray-700">{{ __('Sponsor ID') }}</label>
                    <input type="number" name="sponsor_id" id="sponsor_id"
                        value="{{ old('sponsor_id', $user->sponsor_id) }}" class="w-full border px-3 py-2 rounded">
                </div>
                <div class="mb-4">
                    <label for="rank_id" class="block text-gray-700">{{ __('Rank ID') }}</label>
                    <input type="number" name="rank_id" id="rank_id" value="{{ old('rank_id', $user->rank_id) }}"
                        class="w-full border px-3 py-2 rounded">
                </div>
                <div class="mb-4">
                    <label for="assigned_mentor_id" class="block text-gray-700">{{ __('Assigned Mentor ID') }}</label>
                    <input type="number" name="assigned_mentor_id" id="assigned_mentor_id"
                        value="{{ old('assigned_mentor_id', $user->assigned_mentor_id) }}"
                        class="w-full border px-3 py-2 rounded">
                </div>
                <div class="mb-4">
                    <label for="assigned_manager_id" class="block text-gray-700">{{ __('Assigned Manager ID') }}</label>
                    <input type="number" name="assigned_manager_id" id="assigned_manager_id"
                        value="{{ old('assigned_manager_id', $user->assigned_manager_id) }}"
                        class="w-full border px-3 py-2 rounded">
                </div>
            </div>
            <div x-show="tab === 'location'" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="country_id" class="block text-gray-700">{{ __('Country') }}</label>
                    <select name="country_id" id="country_id"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">{{ __('Select Country') }}</option>
                        @foreach(($countries ?? $activeCountries ?? []) as $country)
                        <option value="{{ $country->id }}" {{ old('country_id', $user->country_id) ==
                            $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                        @endforeach
                    </select>
                    @error('country_id')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="state_province_id" class="block text-gray-700">{{ __('State/Province') }}</label>
                    <select name="state_province_id" id="state_province_id"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">{{ __('Select State/Province') }}</option>
                        @foreach(($states ?? []) as $state)
                        <option value="{{ $state->id }}" {{ old('state_province_id', $user->state_province_id)
                            == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                        @endforeach
                    </select>
                    @error('state_province_id')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="city" class="block text-gray-700">{{ __('City') }}</label>
                    <input type="text" name="city" id="city" value="{{ old('city', $user->city) }}"
                        class="w-full border px-3 py-2 rounded">
                </div>

                <div class="mb-4">
                    <label for="postal_code" class="block text-gray-700">{{ __('Postal Code') }}</label>
                    <input type="text" name="postal_code" id="postal_code"
                        value="{{ old('postal_code', $user->postal_code) }}" class="w-full border px-3 py-2 rounded">
                </div>

                <div class="mb-4">
                    <label for="timezone_id" class="block text-gray-700">{{ __('Timezone') }}</label>
                    <select name="timezone_id" id="timezone_id"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">{{ __('Select Timezone') }}</option>
                        @foreach($timezones as $timezone)
                        <option value="{{ $timezone->id }}" {{ old('timezone_id', $user->timezone_id) ==
                            $timezone->id ? 'selected' : '' }}>{{ $timezone->name }}</option>
                        @endforeach
                    </select>
                    @error('timezone_id')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="best_contact_times" class="block text-gray-700">{{ __('Best Contact Times') }}</label>
                    <select name="best_contact_times" id="best_contact_times"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">{{ __('Select Best Contact Time') }}</option>
                        <option value="Morning" {{ old('best_contact_times', $user->best_contact_times) ==
                            'Morning' ? 'selected' : '' }}>{{ __('Morning') }}</option>
                        <option value="Afternoon" {{ old('best_contact_times', $user->best_contact_times) ==
                            'Afternoon' ? 'selected' : '' }}>{{ __('Afternoon') }}</option>
                        <option value="Evening" {{ old('best_contact_times', $user->best_contact_times) ==
                            'Evening' ? 'selected' : '' }}>{{ __('Evening') }}</option>
                    </select>
                    @error('best_contact_times')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div x-show="tab === 'other'" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="language" class="block text-gray-700">{{ __('Language') }}</label>
                    <input type="text" name="language" id="language" value="{{ old('language', $user->language) }}"
                        class="w-full border px-3 py-2 rounded">
                </div>
                <div class="mb-4">
                    <label for="member_status" class="block text-gray-700">{{ __('Member Status') }}</label>
                    <select name="member_status" id="member_status" class="w-full border px-3 py-2 rounded">
                        <option value="pending" @if($user->member_status == 'pending') selected @endif>Pending</option>
                        <option value="active" @if($user->member_status == 'active') selected @endif>Active</option>
                        <option value="inactive" @if($user->member_status == 'inactive') selected @endif>Inactive
                        </option>
                        <option value="suspended" @if($user->member_status == 'suspended') selected @endif>Suspended
                        </option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="theme_settings" class="block text-gray-700">{{ __('Last Login IP') }}</label>
                    <input type="text" name="last_login_ip" id="last_login_ip"
                        value="{{ old('last_login_ip', $user->last_login_ip) }}"
                        class="w-full border px-3 py-2 rounded bg-gray-100" readonly>
                </div>
                <div class="mb-4">
                    <label for="theme_settings" class="block text-gray-700">{{ __('Last Login At') }}</label>
                    <input type="text" name="last_login_at" id="last_login_at"
                        value="{{ old('last_login_at', $user->last_login_at) }}"
                        class="w-full border px-3 py-2 rounded bg-gray-100" readonly>
                </div>
                <div class="mb-4">
                    <label for="theme_settings" class="block text-gray-700">{{ __('Theme Settings (JSON)') }}</label>
                    <textarea name="theme_settings" id="theme_settings"
                        class="w-full border px-3 py-2 rounded">{{ old('theme_settings', json_encode($user->theme_settings)) }}</textarea>
                </div>
            </div>
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded mt-6">{{ __('Update User')
                }}</button>
            <a href="{{ route('users.index') }}" class="ml-2 text-gray-600">{{ __('Cancel') }}</a>
        </form>
    </div>
</div>
@endsection