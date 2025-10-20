<?php

namespace App\Livewire\Profile;

use App\Models\User;
use App\Models\Country;
use App\Models\StateProvince;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class UpdateLocationForm extends Component
{
    public string $city = '';
    public $state_id = '';
    public $country_id = '';
    public string $timezone = '';

    // Lists for selects
    public $activeCountries = [];
    public $states = [];

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $user = $this->user;
        $this->city = $user->city ?? '';
        $this->state_id = $user->state_id ?? '';
        $this->country_id = $user->country_id ?? '';
        $this->timezone = $user->timezone ?? '';

        // load active countries
        $this->activeCountries = Country::where('is_active', true)->orderBy('name')->get(['id', 'name']);

        // load states for selected country
        if ($this->country_id) {
            $this->states = StateProvince::where('country_id', $this->country_id)->orderBy('name')->get(['id', 'name']);
        } else {
            $this->states = [];
        }
    }

    /**
     * Update the location information for the currently authenticated user.
     */
    public function updateLocation(): void
    {
        $user = $this->user;

        $validated = $this->validate([
            'city' => ['nullable', 'string', 'max:255'],
            'state_id' => ['nullable', 'integer'],
            'country_id' => ['nullable', 'integer'],
            'timezone' => ['nullable', 'string', 'max:255'],
        ]);

        $user->update($validated);

        $this->dispatch('location-updated');

        Session::flash('status', 'location-updated');
    }

    /**
     * Load states when country is changed from the select
     */
    public function updateStatesForCountry($value): void
    {
        if ($value) {
            $this->states = StateProvince::where('country_id', $value)->orderBy('name')->get(['id', 'name']);
        } else {
            $this->states = [];
        }
        $this->state_id = '';
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