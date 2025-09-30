<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class UpdateLocationForm extends Component
{
    public string $city = '';
    public string $province_state = '';
    public string $country = '';
    public string $timezone = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $user = $this->user;
        
        $this->city = $user->city ?? '';
        $this->province_state = $user->province_state ?? '';
        $this->country = $user->country ?? '';
        $this->timezone = $user->timezone ?? '';
    }

    /**
     * Update the location information for the currently authenticated user.
     */
    public function updateLocation(): void
    {
        $user = $this->user;

        $validated = $this->validate([
            'city' => ['nullable', 'string', 'max:255'],
            'province_state' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'size:2'],
            'timezone' => ['nullable', 'string', 'max:255'],
        ]);

        $user->update($validated);

        $this->dispatch('location-updated');

        Session::flash('status', 'location-updated');
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
        return view('livewire.profile.update-location-form');
    }
}