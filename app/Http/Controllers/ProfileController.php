<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit()
    {
        // Return the main profile page with tabs; the Livewire components will mount themselves
        return view('profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // You may want to use session flash or redirect with message
        return redirect()->back()->with('status', 'profile-updated');
    }

    public function sendVerification()
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }

        $user->sendEmailVerificationNotification();
        Session::flash('status', 'verification-link-sent');
        return redirect()->back();
    }
    /**
     * Show the settings page.
     */
    public function settings()
    {
        return view('settings');
    }
}
