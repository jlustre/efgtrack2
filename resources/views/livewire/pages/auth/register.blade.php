<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $username = '';
    public string $sponsor = '';
    public string $sponsor_error = '';
    public ?int $sponsor_id = null;

    public function mount(): void
    {
        $sp = request()->query('sp');
        if ($sp && is_numeric($sp)) {
            session(['registration_sponsor_id' => $sp]);
        }
        $sponsorId = session('registration_sponsor_id');
        if ($sponsorId && is_numeric($sponsorId)) {
            $sponsorUser = User::find($sponsorId);
            if ($sponsorUser) {
                $this->sponsor = $sponsorUser->username;
                $this->sponsor_id = (int) $sponsorUser->id;
                $this->sponsor_error = '';
            } else {
                $this->sponsor_id = null;
            }
        }
    }

    /**
     * Real-time sponsor validation
     */
    public function updatedSponsor($value): void
    {
    // ...existing code...
        $value = trim($value);
        if ($value === '') {
            $this->sponsor_id = null;
            $this->sponsor_error = '';
            $this->resetErrorBag('sponsor');
            return;
        }
    $user = \App\Models\User::where('username', $value)->where('member_status', 'active')->first();
        if ($user) {
            $this->sponsor_id = (int) $user->id;
        } else {
            $this->sponsor_id = null;
        }
        if (!is_null($this->sponsor_id)) {
            $this->sponsor_error = '';
            $this->resetErrorBag('sponsor');
        } else {
            $this->sponsor_error = 'Sponsor must be an active member.';
        }
        // Force output for debugging
        // Remove after debugging
        // dd(['input' => $value, 'user' => $user, 'sponsor_id' => $this->sponsor_id, 'sponsor_error' => $this->sponsor_error]);
    }

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $isAdmin = Auth::check() && Auth::user()->hasRole('admin');
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ];
        if ($isAdmin) {
            $rules['username'] = [
                'required', 'string', 'max:25', 'regex:/^[a-z0-9_]+$/', 'unique:' . User::class,
            ];
            $rules['sponsor'] = ['required', 'string'];
        }
        $messages = [
            'username.max' => 'The username must not be greater than 25 characters.',
            'sponsor.required' => 'A sponsor is required.',
        ];
        $validated = $this->validate($rules, $messages);

        if ($isAdmin) {
            $validated['username'] = strtolower($validated['username']);
            $sponsorUser = \App\Models\User::where('username', $this->sponsor)->where('member_status', 'active')->first();
            if (!$sponsorUser) {
                $this->addError('sponsor', 'Sponsor must be an active member.');
                return;
            }
            $this->sponsor_id = $sponsorUser->id;
            $validated['sponsor_id'] = $this->sponsor_id;
        } else {
            // For non-admins, prevent modification of username and sponsor_id
            unset($validated['username'], $validated['sponsor']);
            $validated['username'] = $this->username;
            $validated['sponsor_id'] = $this->sponsor_id;
        }

    $validated['password'] = Hash::make($validated['password']);
    $validated['last_active_at'] = now()->toDateString();
    $validated['rank_id'] = 1;
    $assignedManager = null;
    if ($this->sponsor_id) {
        $upline = User::find($this->sponsor_id);
        while ($upline) {
            if ($upline->hasRole('manager')) {
                $assignedManager = $upline->id;
                break;
            }
            $upline = $upline->sponsor_id ? User::find($upline->sponsor_id) : null;
        }
    }
    $validated['assigned_manager_id'] = $assignedManager;

    event(new Registered($user = User::create($validated)));

    Auth::login($user);

    // Set login info after registration
    $user->last_login_at = now();
    $user->last_login_ip = request()->ip();
    $user->is_online = true;
    $user->save();

    // Clear sponsor id from session after registration
    session()->forget('registration_sponsor_id');
    $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <!-- Page Header -->
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Create Account</h2>
        <p class="text-gray-600">Join EFGTrack to manage your team effectively</p>
    </div>

    <form wire:submit="register" class="space-y-6">
        <!-- Display all validation errors -->
        @if ($errors->any())
        <div class="mb-4 rounded-lg bg-red-50 border border-red-200 p-4">
            <ul class="list-disc list-inside text-sm text-red-700">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Display success message -->
        @if (session('success'))
        <div class="mb-4 rounded-lg bg-green-50 border border-green-200 p-4 text-green-700">
            {{ session('success') }}
        </div>
        @endif
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <!-- Sponsor (with Livewire real-time validation) -->
            <div class="space-y-2" x-data="{
                sponsorId: @entangle('sponsor_id'),
                sponsorInput: @entangle('sponsor'),
                sponsorValid: false,
                init() {
                    window.addEventListener('sponsorValid', e => {
                        this.sponsorId = e.detail;
                        this.sponsorValid = true;
                    });
                    window.addEventListener('sponsorInvalid', () => {
                        this.sponsorId = null;
                        this.sponsorValid = false;
                    });
                }
            }" x-init="init()">
                <label for="sponsor" class="block text-sm font-medium text-gray-700">
                    Sponsor <span class="text-red-600">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <input wire:model.lazy="sponsor" id="sponsor" name="sponsor" type="text" required autocomplete="off"
                        @if($sponsor_id===null) autofocus @endif
                        class="input-focus block w-full pl-10 pr-3 py-3 border rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 sm:text-sm {{ $errors->has('sponsor') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 focus:ring-blue-500 focus:border-blue-500' }}"
                        placeholder="Enter sponsor name">
                </div>
                <!-- Livewire sponsor validation feedback -->
                @if(!empty($sponsor_error) && is_null($sponsor_id))
                <p class="mt-1 text-xs text-red-600 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ $sponsor_error }}
                </p>
                @endif
                <!-- ...existing code... -->
                @error('sponsor')
                <p class="mt-1 text-sm text-red-600 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>

            <!-- Username -->
            <div class="space-y-2">
                <label for="username" class="block text-sm font-medium text-gray-700">
                    Username <span class="text-red-600">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <input x-data x-ref="usernameInput" x-on:input="
                            let val = $refs.usernameInput.value.toLowerCase().replace(/\s+/g, '').replace(/[^a-z0-9_]/g, '');
                            if (val.length > 25) val = val.slice(0, 25);
                            if ($refs.usernameInput.value !== val) {
                                $refs.usernameInput.value = val;
                                $dispatch('input', val);
                            }
                        " maxlength="25" wire:model.debounce.500ms="username" id="username" name="username" type="text"
                        required autocomplete="username" @if($sponsor_id) autofocus @endif
                        class="input-focus block w-full pl-10 pr-3 py-3 border rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 sm:text-sm {{ $errors->has('username') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 focus:ring-blue-500 focus:border-blue-500' }}"
                        placeholder="Choose a username">
                </div>
                @error('username')
                <p class="mt-1 text-sm text-red-600 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ $message }}
                </p>
                @enderror
                <template x-if="$wire.username && ($wire.username.length > 0 && !$wire.username.match(/^[a-z0-9_]+$/))">
                    <p class="mt-1 text-sm text-red-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Username must be lowercase, unique, and contain no spaces or special characters.
                    </p>
                </template>
                <template x-if="$wire.username && $wire.username.length === 25">
                    <p class="mt-1 text-sm text-red-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Maximum of 25 characters reached.
                    </p>
                </template>
            </div>
        </div>
        <!-- Name -->
        <div class="space-y-2" x-data="{
    fullName: @entangle('name').defer,
    firstName: @entangle('first_name'),
    lastName: @entangle('last_name'),
        splitFullName() {
            if (!this.fullName) {
                this.firstName = '';
                this.lastName = '';
                return;
            }
            let parts = this.fullName.trim().split(/\s+/);
            this.firstName = parts[0] || '';
            this.lastName = parts.length > 1 ? parts.slice(1).join(' ') : '';
        }
        }">
            <label for=" name" class="block text-sm font-medium text-gray-700">
                Full Name <span class="text-red-600">*</span>
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <input wire:model="name" id="name" name="name" type="text" required autofocus autocomplete="name"
                    class="input-focus block w-full pl-10 pr-3 py-3 border rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 sm:text-sm {{ $errors->has('name') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 focus:ring-blue-500 focus:border-blue-500' }}"
                    placeholder="Enter your full name" x-model="fullName" @input="splitFullName()">
            </div>
            @error('name')
            <p class="mt-1 text-sm text-red-600 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
                {{ $message }}
            </p>
            @enderror
            <!-- First and Last Name fields, shown only if Full Name is not empty -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-2">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                    <input id="first_name" name="first_name" type="text"
                        class="block w-full pl-3 pr-3 py-2 border rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 sm:text-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        x-model="firstName" wire:model="first_name" @input="$wire.set('first_name', firstName)">
                </div>
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input id="last_name" name="last_name" type="text"
                        class="block w-full pl-3 pr-3 py-2 border rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 sm:text-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        x-model="lastName" wire:model="last_name" @input="$wire.set('last_name', lastName)">
                </div>
            </div>
        </div>

        <!-- Email Address -->
        <div class="space-y-2">
            <label for="email" class="block text-sm font-medium text-gray-700">
                Email Address <span class="text-red-600">*</span>
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                </div>
                <input wire:model="email" id="email" name="email" type="email" required autocomplete="username"
                    class="input-focus block w-full pl-10 pr-3 py-3 border rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 sm:text-sm {{ $errors->has('email') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 focus:ring-blue-500 focus:border-blue-500' }}"
                    placeholder="Enter your email address">
            </div>
            @error('email')
            <p class="mt-1 text-sm text-red-600 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
                {{ $message }}
            </p>
            @enderror
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <label for="password" class="block text-sm font-medium text-gray-700">
                Password <span class="text-red-600">*</span>
            </label>
            <div class="relative" x-data="{ showPassword: false }">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <input wire:model="password" id="password" name="password" :type="showPassword ? 'text' : 'password'"
                    required autocomplete="new-password"
                    class="input-focus block w-full pl-10 pr-10 py-3 border rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 sm:text-sm {{ $errors->has('password') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 focus:ring-blue-500 focus:border-blue-500' }}"
                    placeholder="Create a secure password">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <button type="button" @click="showPassword = !showPassword"
                        class="text-gray-400 hover:text-gray-600 focus:outline-none focus:text-gray-600 transition-colors">
                        <svg x-show="!showPassword" class="h-5 w-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg x-show="showPassword" class="h-5 w-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L12 12m0 0l3.121-3.121M12 12v6.5" />
                        </svg>
                    </button>
                </div>
            </div>
            @error('password')
            <p class="mt-1 text-sm text-red-600 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
                {{ $message }}
            </p>
            @enderror
            <div class="text-xs text-gray-500">
                Must be at least 8 characters with a mix of letters, numbers & symbols
            </div>
        </div>

        <!-- Confirm Password -->
        <div class="space-y-2">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                Confirm Password <span class="text-red-600">*</span>
            </label>
            <div class="relative" x-data="{ showConfirmPassword: false }">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <input wire:model="password_confirmation" id="password_confirmation" name="password_confirmation"
                    :type="showConfirmPassword ? 'text' : 'password'" required autocomplete="new-password"
                    class="input-focus block w-full pl-10 pr-10 py-3 border rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 sm:text-sm {{ $errors->has('password_confirmation') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 focus:ring-blue-500 focus:border-blue-500' }}"
                    placeholder="Confirm your password">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <button type="button" @click="showConfirmPassword = !showConfirmPassword"
                        class="text-gray-400 hover:text-gray-600 focus:outline-none focus:text-gray-600 transition-colors">
                        <svg x-show="!showConfirmPassword" class="h-5 w-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg x-show="showConfirmPassword" class="h-5 w-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L12 12m0 0l3.121-3.121M12 12v6.5" />
                        </svg>
                    </button>
                </div>
            </div>
            @error('password_confirmation')
            <p class="mt-1 text-sm text-red-600 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
                {{ $message }}
            </p>
            @enderror
        </div>

        <!-- Terms & Privacy Agreement -->
        <div class="space-y-4">
            <div class="flex items-start">
                <input id="terms" type="checkbox" required
                    class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="terms" class="ml-2 text-sm text-gray-600 select-none">
                    I agree to the <span class="text-red-600">*</span>
                    <a href="{{ route('terms-of-service') }}" target="_blank"
                        class="text-blue-600 hover:text-blue-500 font-medium underline">Terms of Service</a>
                    and
                    <a href="{{ route('privacy-policy') }}" target="_blank"
                        class="text-blue-600 hover:text-blue-500 font-medium underline">Privacy Policy</a>
                </label>
            </div>
        </div>

        <!-- Required Legend -->
        <div class="text-xs text-gray-500 mb-2"><span class="text-red-600">*</span> Required fields</div>
        <!-- Submit Button -->
        <div class="space-y-4">
            <button type="submit" :disabled="!$wire.sponsor_id"
                class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 transform hover:-translate-y-0.5 hover:shadow-lg">
                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-blue-500 group-hover:text-blue-400 transition-colors" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
                Create Account
            </button>

            <!-- Login Link -->
            <div class="text-center">
                <span class="text-sm text-gray-600">Already have an account?</span>
                <a href="{{ route('login') }}" wire:navigate
                    class="ml-1 text-sm text-blue-600 hover:text-blue-500 font-medium transition-colors">
                    Sign in here
                </a>
            </div>
        </div>
    </form>
</div>