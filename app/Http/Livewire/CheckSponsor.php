<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;


class CheckSponsor extends Component
{
    public $sponsor = '';
    public $error = '';

    public function mount($sponsor = '')
    {
        $this->sponsor = $sponsor;
    }

    // No listeners needed; validation is handled by updatedSponsor

    public function updatedSponsor($value)
    {
        $this->checkSponsor($value);
    }

    public function checkSponsor($value = null)
    {
        $username = $value ?? $this->sponsor;
    $user = User::where('username', $username)->where('is_active', true)->first();
        if ($user) {
            $this->error = '';
            // Prefer emitting upward via Livewire if available; otherwise dispatch a browser event
            if (method_exists($this, 'emitUp')) {
                $this->emitUp('sponsorValid', $user->id);
            }
            $this->dispatchBrowserEvent('sponsor-valid', ['id' => $user->id]);
        } else {
            $this->error = 'Sponsor must be an active member.';
            if (method_exists($this, 'emitUp')) {
                $this->emitUp('sponsorInvalid');
            }
            $this->dispatchBrowserEvent('sponsor-invalid');
        }
    }

    public function render()
    {
        // Always validate sponsor on render if not empty
        if ($this->sponsor !== '') {
            $this->checkSponsor($this->sponsor);
        } else {
            $this->error = '';
        }
        return view('livewire.check-sponsor');
    }
}
