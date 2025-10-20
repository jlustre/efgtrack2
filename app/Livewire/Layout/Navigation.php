<?php

namespace App\Livewire\Layout;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Navigation extends Component
{
    /**
     * Logout the current user and redirect to the homepage.
     * The test calls this method directly on the Livewire component.
     */
    public function logout()
    {
        $user = Auth::user();

        if ($user) {
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();
        }

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.layout.navigation');
    }
}
