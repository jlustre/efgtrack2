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
            $this->emitUp('sponsorValid', $user->id);
        } else {
            $this->error = 'Sponsor must be an active member.';
            $this->emitUp('sponsorInvalid');
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
