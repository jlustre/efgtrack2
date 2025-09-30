<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UpdateProfileInformationForm extends Component
{
    public string $name = '';
    public string $first_name = '';
    public string $last_name = '';
    public string $username = '';
    public string $email = '';
    public string $phone = '';
    public string $emergency_contact = '';
    public string $city = '';
    public string $province_state = '';
    public string $country = '';
    public string $timezone = '';
    public string $preferred_contact_method = 'email';
    public bool $email_notifications = true;
    public bool $sms_notifications = false;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $user = $this->user;
        
        $this->name = $user->name;
        $this->first_name = $user->first_name ?? '';
        $this->last_name = $user->last_name ?? '';
        $this->username = $user->username ?? '';
        $this->email = $user->email;
        $this->phone = $user->phone ?? '';
        $this->emergency_contact = $user->emergency_contact ?? '';
        $this->city = $user->city ?? '';
        $this->province_state = $user->province_state ?? '';
        $this->country = $user->country ?? '';
        $this->timezone = $user->timezone ?? '';
        $this->preferred_contact_method = $user->preferred_contact_method ?? 'email';
        $this->email_notifications = $user->email_notifications ?? true;
        $this->sms_notifications = $user->sms_notifications ?? false;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = $this->user;

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'username' => [
                'nullable', 
                'string', 
                'max:255', 
                'regex:/^[a-zA-Z0-9_]+$/',
                Rule::unique(User::class)->ignore($user->id)
            ],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'emergency_contact' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'province_state' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'size:2'],
            'timezone' => ['nullable', 'string', 'max:255'],
            'preferred_contact_method' => ['required', 'in:email,phone,both'],
            'email_notifications' => ['boolean'],
            'sms_notifications' => ['boolean'],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);

        Session::flash('status', 'profile-updated');
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = $this->user;

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    /**
     * Get the current user of the application.
     */
    public function getUserProperty(): ?User
    {
        return Auth::user();
    }

    public function render()
    {
        return view('livewire.profile.update-profile-information-form');
    }
}