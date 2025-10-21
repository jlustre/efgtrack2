<?php

namespace App\Livewire\Profile;

use App\Models\User;
use App\Models\Country;
use App\Models\StateProvince;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UpdateProfileInformationForm extends Component
{
    public string $readonly = '';
    public bool $isAdmin = false;
    // Which tab/view this instance should render (personal|business|location|etc)
    public string $tab = 'personal';
    public $activeCountries = [];
    public $stateOptions = [];
    // Business info
    public $ranks = [];
    public $mentors = [];
    public $managers = [];
    public $rank_id = null;
    public $assigned_mentor_id = null;
    public $assigned_manager_id = null;
    public $is_licensed = null;
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
    // Best contact times (single selection in the UI, stored as JSON array in DB)
    public $best_contact_times = '';
    // Sponsor id (hidden input / display only in the UI)
    public $sponsor_id = null;
    // UI flag to indicate a successful save (used for inline messages)
    public bool $showSuccess = false;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        // allow caller to pass which tab/view we should render
        if (request()->has('tab')) {
            $this->tab = request('tab');
        }
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
        $this->activeCountries = [];
        $this->stateOptions = [];
        $this->country = $user->country ?? '';
        $this->timezone = $user->timezone ?? '';
        $this->preferred_contact_method = $user->preferred_contact_method ?? 'email';
        $this->email_notifications = $user->email_notifications ?? true;
        $this->sms_notifications = $user->sms_notifications ?? false;

        // Best contact times: user model casts this to array. In the UI we use a single-select
        // so normalize any stored array to a single value for the select input.
        $storedBest = $user->best_contact_times ?? null;
        if (is_array($storedBest)) {
            $this->best_contact_times = $storedBest[0] ?? '';
        } else {
            $this->best_contact_times = $storedBest ?? '';

        // Sponsor id
        $this->sponsor_id = $user->sponsor_id ?? null;
        }

    // Business info
    $this->rank_id = $user->rank_id ?? null;
    $this->assigned_mentor_id = $user->assigned_mentor_id ?? null;
    $this->assigned_manager_id = $user->assigned_manager_id ?? null;
    $this->is_licensed = isset($user->is_licensed) ? (int) $user->is_licensed : null;

        // Set readonly for username if not admin. Avoid calling hasRole() when
        // Spatie permission tables are not present (for example, lightweight
        // sqlite test databases). Check schema existence first and then call
        // hasRole() inside a try/catch as a last line of defense.
        $isAdmin = false;
        try {
            if ($user && Schema::hasTable('roles') && Schema::hasTable('model_has_roles') && method_exists($user, 'hasRole')) {
                $isAdmin = (bool) $user->hasRole('admin');
            }
        } catch (\Throwable $e) {
            // If anything goes wrong, default to non-admin to keep behavior safe.
            $isAdmin = false;
        }

        $this->readonly = (!$user || !$isAdmin) ? 'readonly' : '';
        $this->isAdmin = $isAdmin;

        // Fetch only active countries
        $this->activeCountries = Country::where('is_active', true)->orderBy('name')->get(['id', 'name']);
        
        // Fetch initial states for selected country (by country ID)
        if ($this->country) {
            $this->stateOptions = StateProvince::where('country_id', $this->country)->orderBy('name')->get(['id', 'name']);
        } else {
            $this->stateOptions = [];
        }

        // Load ranks and user lists for mentors/managers
        // Prefer ordering ranks by their numeric 'level' column; if that column doesn't exist,
        // fall back to ordering by name so the component remains resilient across schemas.
        try {
            $this->ranks = DB::table('ranks')
                ->select('id', 'name', 'level')
                ->orderBy('level', 'asc')
                ->get();
        } catch (\Throwable $e) {
            // Fallback: select only id/name ordered alphabetically
            $this->ranks = DB::table('ranks')
                ->select('id', 'name')
                ->orderBy('name', 'asc')
                ->get();
        }

        // Mentors and managers: fetch users with specific roles. Wrap in try/catch because
        // Spatie's roles tables may not exist in test environments; fallback to empty collections.
        try {
            // Only attempt role-based queries if the Spatie roles tables exist in this DB.
            if (\Illuminate\Support\Facades\Schema::hasTable('roles') && \Illuminate\Support\Facades\Schema::hasTable('model_has_roles')) {
                $this->mentors = User::role('mentor')
                    ->orderBy('first_name')
                    ->orderBy('last_name')
                    ->get(['id', 'first_name', 'last_name'])
                    ->map(function ($u) {
                        $u->display_name = trim(($u->first_name ?? '') . ' ' . ($u->last_name ?? '')) ?: ($u->username ?? 'User '.$u->id);
                        return $u;
                    });

                $this->managers = User::role('manager')
                    ->orderBy('first_name')
                    ->orderBy('last_name')
                    ->get(['id', 'first_name', 'last_name'])
                    ->map(function ($u) {
                        $u->display_name = trim(($u->first_name ?? '') . ' ' . ($u->last_name ?? '')) ?: ($u->username ?? 'User '.$u->id);
                        return $u;
                    });
            } else {
                $this->mentors = collect([]);
                $this->managers = collect([]);
            }
        } catch (\Throwable $e) {
            // Roles missing or query failed; fall back to empty collections to allow tests to run.
            $this->mentors = collect([]);
            $this->managers = collect([]);
        }
    }

    public function updatedCountry($value)
    {
        // $value is now country ID
        if ($value) {
            $this->stateOptions = \App\Models\StateProvince::where('country_id', $value)->orderBy('name')->get(['code', 'name']);
        } else {
            $this->stateOptions = [];
        }
        $this->province_state = '';
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = $this->user;
        // continue processing

    $rules = [
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
            'timezone' => ['nullable', 'string', 'max:255'],
            'preferred_contact_method' => ['required', 'in:email,phone,both'],
            'email_notifications' => ['boolean'],
            'sms_notifications' => ['boolean'],
            // business
            'rank_id' => ['nullable', 'integer', 'exists:ranks,id'],
            'assigned_mentor_id' => ['nullable', 'integer', 'exists:users,id'],
            'assigned_manager_id' => ['nullable', 'integer', 'exists:users,id'],
            'is_licensed' => ['nullable', 'in:0,1'],
            'best_contact_times' => ['nullable', 'string', 'max:255'],
            'sponsor_id' => ['nullable', 'integer', 'exists:users,id'],
        ];

        // Exclude 'country' field validation for the 'personal' tab
        if ($this->tab !== 'personal') {
            $rules['country'] = ['nullable', 'string', 'size:2'];
        }

        $validated = $this->validate($rules);

        // Map validated inputs to user attributes (some keys may not match DB names)
        $map = $validated;
        if (array_key_exists('rank_id', $validated)) {
            $map['rank_id'] = $validated['rank_id'];
        }
        if (array_key_exists('assigned_mentor_id', $validated)) {
            $map['assigned_mentor_id'] = $validated['assigned_mentor_id'];
        }
        if (array_key_exists('assigned_manager_id', $validated)) {
            $map['assigned_manager_id'] = $validated['assigned_manager_id'];
        }
        if (array_key_exists('is_licensed', $validated)) {
            $map['is_licensed'] = $validated['is_licensed'] === '1' || $validated['is_licensed'] === 1 ? 1 : 0;
        }

        // Sponsor: don't overwrite DB value with null/empty when the input was empty.
        // Some DBs have sponsor_id as NOT NULL; avoid setting it to null unintentionally.
        if (array_key_exists('sponsor_id', $validated)) {
            if ($validated['sponsor_id'] === null || $validated['sponsor_id'] === '') {
                // Remove from map so existing DB value is preserved
                unset($map['sponsor_id']);
            } else {
                $map['sponsor_id'] = $validated['sponsor_id'];
            }
        }

        // Persist best_contact_times as an array (model casts to array)
        if (array_key_exists('best_contact_times', $validated)) {
            $map['best_contact_times'] = $validated['best_contact_times'] === null || $validated['best_contact_times'] === ''
                ? null
                : [$validated['best_contact_times']];
        }

        $user->fill($map);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Mark success for inline UI feedback
        $this->showSuccess = true;

        // Helpful server-side logging for debugging
        try {
            \Illuminate\Support\Facades\Log::info('[Livewire] profile updated for user', ['id' => $user->id, 'email' => $user->email]);
        } catch (\Throwable $e) {
            // ignore logging failures
        }

        // Notify clients. Prefer dispatchBrowserEvent when available (newer Livewire),
        // otherwise fall back to emit() for older Livewire versions. If neither
        // exists, just set the session flash so server-rendered pages still show a message.
        try {
            if (method_exists($this, 'dispatchBrowserEvent')) {
                $this->dispatchBrowserEvent('profile-updated', ['name' => $user->name]);
            } elseif (method_exists($this, 'emit')) {
                $this->emit('profile-updated', ['name' => $user->name]);
            }
        } catch (\Throwable $e) {
            // If notifying the client fails for any reason, continue — session flash
            // provides a server-side fallback for classic requests/tests.
        }

        // Always dispatch a browser event and emit the Livewire event so frontend
        // listeners (both DOM and Livewire) reliably receive the notification.
        try {
            if (method_exists($this, 'dispatchBrowserEvent')) {
                $this->dispatchBrowserEvent('profile-updated', ['name' => $user->name]);
            }
        } catch (\Throwable $e) {
            // ignore
        }

        try {
            if (method_exists($this, 'emit')) {
                $this->emit('profile-updated', ['name' => $user->name]);
            }
        } catch (\Throwable $e) {
            // ignore
        }

        // Also instruct the complete-profile-modal (if present) to hide itself after a successful save
        try {
            if (method_exists($this, 'emitTo')) {
                $this->emitTo('profile.complete-profile-modal', 'hideModal');
            }
        } catch (\Throwable $e) {
            // ignore; non-fatal
        }

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
        // Always pass activeCountries and stateOptions to any view rendered by this component
        $view = $this->getViewName();
        return view($view, [
            'activeCountries' => $this->activeCountries,
            'stateOptions' => $this->stateOptions,
            'ranks' => $this->ranks,
            'mentors' => $this->mentors,
            'managers' => $this->managers,
        ]);

    }

    /**
     * Determine which view to render based on context or tab.
     */
    protected function getViewName(): string
    {
        // Prefer explicit tab set on the component, fallback to request params
        switch ($this->tab) {
            case 'location':
                return 'livewire.profile.update-location-form';
            case 'business':
                return 'livewire.profile.update-business-info-form';
            case 'password':
                return 'livewire.profile.update-password-form';
            default:
                return 'livewire.profile.update-profile-information-form';
        }

    // Also support other views that need activeCountries
    // If you use update-location-form.blade.php, add:
    // return view('livewire.profile.update-location-form', [
    //     'activeCountries' => $this->activeCountries,
    //     'stateOptions' => $this->stateOptions,
    // ]);
    }
}