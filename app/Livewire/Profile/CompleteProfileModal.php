<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CompleteProfileModal extends Component
{
    use WithFileUploads;
    public $user;
    public $fields = [
        'sponsor_id', 'username', 'name', 'first_name', 'last_name', 'email',
        'phone', 'avatar_path', 'country_id', 'state_id', 'city', 'postal_code', 'timezone', 'best_contact_times', 'is_licensed'
    ]; 
    // password removed for modal, country_id and state_id moved before city
    // public $country_code = null;
    public $countries = [];
    public $states = [];
    public $timezones = [];
    public $sponsor_username = null;
    public $form = [];
    public $show = false;
    public $percent = 0;
    public $success = false;

    // Allow other components to open this modal explicitly
    protected $listeners = [
        'hideModal' => 'closeModal',
        'openModal' => 'openModal',
    ];

    public function openModal()
    {
        $this->success = false;
        $this->show = true;
    }

    public function hideSuccessMessage()
    {
        $this->success = false;
        $this->show = false;
    }
    // ...existing code...

    public function continueFillingUp()
    {
        $this->success = false;
        $this->show = true;
    }

    public function closeModal()
    {
    $this->show = false;
    $this->dispatch('close-modal', name: 'complete-profile-modal');
    }

    public function mount()
    {
        Log::info('[Livewire Debug] mount() called');
        $this->user = Auth::user();
        foreach ($this->fields as $field) {
            $this->form[$field] = $this->user->$field;
        }
        // Always set avatar_path to the database value if it is a string (filename)
        if (is_string($this->user->avatar_path) && !empty($this->user->avatar_path)) {
            $this->form['avatar_path'] = $this->user->avatar_path;
        }
        // Get sponsor username if sponsor_id exists
        if ($this->user->sponsor_id) {
            $sponsor = \App\Models\User::find($this->user->sponsor_id);
            $this->sponsor_username = $sponsor ? $sponsor->username : null;
        }
        // Get active countries for dropdown
        $this->countries = \App\Models\Country::where('is_active', true)->orderBy('name')->get();
        // Get states for selected country_id
        $this->states = $this->form['country_id']
            ? \App\Models\StateProvince::where('country_id', $this->form['country_id'])->orderBy('name')->get()
            : collect();
        // Get active timezones for dropdown
    $this->timezones = DB::table('timezones')->where('is_active', true)->orderBy('name')->get();
        $this->percent = $this->user->getProfileCompletionPercent();

        // Only auto-show the modal when the user is on the dashboard page.
        // Avoid auto-opening the modal on other pages like the profile edit page.
        try {
            $this->show = ($this->percent < 100) && request()->routeIs('dashboard');
        } catch (\Throwable $e) {
            // If route helper isn't available for some reason, default to not showing.
            $this->show = false;
        }
    }

    public function updateStatesForCountry()
    {
        $countryId = $this->form['country_id'];
        $this->states = $countryId
            ? \App\Models\StateProvince::where('country_id', $countryId)->orderBy('name')->get()
            : collect();
        $this->form['state_id'] = '';
        // Log debug info
        Log::info('[Livewire Debug] country_id: ' . ($countryId ?? 'null'));
        $statesCollection = collect($this->states);
        Log::info('[Livewire Debug] states count: ' . $statesCollection->count());
        Log::info('[Livewire Debug] state IDs: ' . implode(', ', $statesCollection->pluck('id')->all()));
        Log::info('[Livewire Debug] state names: ' . implode(', ', $statesCollection->pluck('name')->all()));
    }

    public function calculatePercent()
    {
        $filled = 0;
        foreach ($this->fields as $field) {
            if (!empty($this->form[$field])) {
                $filled++;
            }
        }
        return round(($filled / count($this->fields)) * 100, 2);
    }

    public function save()
    {
        $rules = [
            'sponsor_id' => 'nullable',
            'username' => 'nullable',
            'name' => 'nullable',
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'avatar_path' => 'nullable',
            'city' => 'nullable',
            'state_id' => 'nullable',
            'country_id' => 'nullable',
            'postal_code' => 'nullable',
            'timezone' => 'nullable',
            'best_contact_times' => 'nullable',
            'is_licensed' => 'nullable|boolean',
        ];
        // Require state_id if country_id is selected
        if (!empty($this->form['country_id'])) {
            $rules['state_id'] = 'required|integer';
        }
        $validated = Validator::make($this->form, $rules)->validate();
        // Handle avatar upload and store only filename
        // Don't overwrite sponsor_id with null if it's not provided (protect NOT NULL DB column)
        if (array_key_exists('sponsor_id', $validated) && ($validated['sponsor_id'] === null || $validated['sponsor_id'] === '')) {
            unset($validated['sponsor_id']);
        }
        if (!empty($this->form['avatar_path']) && is_object($this->form['avatar_path'])) {
            $avatarPath = $this->form['avatar_path']->store('avatars', 'public');
            $filename = basename($avatarPath);
            $validated['avatar_path'] = $filename;
            \Illuminate\Support\Facades\Log::info('[Livewire Debug] avatar_path to save: ' . $filename);
        }
    $this->user->fill($validated);
    $this->user->updateProfileCompletion();
    $this->user->save();
    $this->user = $this->user->fresh(); // Reload user from DB for updated avatar_path
    \Illuminate\Support\Facades\Log::info('[Livewire Debug] user->avatar_path after save: ' . $this->user->avatar_path);
    $this->form['avatar_path'] = $this->user->avatar_path; // Sync form for persistent preview
    $this->percent = $this->user->getProfileCompletionPercent();
    $this->show = $this->percent < 100;
    $this->success = true;
    }

    public function render()
    {
        return view('livewire.profile.complete-profile-modal');
    }

    
}
