<?php

namespace App\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class DeleteUserForm extends Component
{
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), function ($user) {
            Auth::logout();
            
            $user->delete();
        });

        session()->invalidate();
        session()->regenerateToken();

        $this->redirect('/');
    }

    public function render()
    {
        return view('livewire.profile.delete-user-form');
    }
}