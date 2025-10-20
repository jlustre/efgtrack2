@extends('layouts.app')

@section('page-title')
Profile Management
@endsection

@section('content')
<div class="py-6 md:py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <!-- Profile Header Card -->
                @include('components.profile-header')
                <!-- Error Message -->
                @include('components.form-error-alert')

                <!-- Flash messages root -->
                <div data-flash-root>
                    @if(session()->has('status') || session()->has('status_message'))
                    @php
                    $msg = session('status_message') ?: session('status');
                    $type = session('status_type') ?? (session('status') === 'profile-updated' ? 'success' : 'success');
                    @endphp
                    @include('components.flash-message', ['type' => $type, 'message' => $msg])
                    @endif
                </div>
                @include('components.flash-message-scripts')

                <!-- Tabbed Main Content -->
                <div x-data="{ tab: 'personal' }"
                    x-init="() => { const t = sessionStorage.getItem('profile.activeTab'); if (t) tab = t; $watch('tab', v => sessionStorage.setItem('profile.activeTab', v)); }"
                    class="mt-6">
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                            <button
                                :class="tab === 'personal' ? 'border-primary-600 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                @click="tab = 'personal'"
                                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm focus:outline-none">{{
                                __('Personal Information') }}</button>
                            <button
                                :class="tab === 'location' ? 'border-primary-600 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                @click="tab = 'location'"
                                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm focus:outline-none">{{
                                __('Location Info') }}</button>
                            <button
                                :class="tab === 'business' ? 'border-primary-600 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                @click="tab = 'business'"
                                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm focus:outline-none">{{
                                __('Business Info') }}</button>
                            <button
                                :class="tab === 'password' ? 'border-primary-600 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                @click="tab = 'password'"
                                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm focus:outline-none">{{
                                __('Password') }}</button>
                            <button
                                :class="tab === 'others' ? 'border-primary-600 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                @click="tab = 'others'"
                                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm focus:outline-none">{{
                                __('Others') }}</button>
                        </nav>
                    </div>
                    <div class="bg-white shadow-sm sm:rounded-lg mt-4">
                        <div x-show="tab === 'personal'">
                            @include('profile-tabs.personal-info')
                        </div>
                        <div x-show="tab === 'location'">
                            @include('profile-tabs.location-info')
                        </div>
                        <div x-show="tab === 'business'">
                            <livewire:profile.update-profile-information-form :tab="'business'" />
                        </div>
                        <div x-show="tab === 'password'">
                            @include('profile-tabs.password')
                        </div>
                        <div x-show="tab === 'others'">
                            @include('profile-tabs.others')
                            {{-- Ensure the delete account Livewire component is present (tests expect it) --}}
                            <livewire:profile.delete-user-form />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.avatar-upload-modal')
</div>
@endsection