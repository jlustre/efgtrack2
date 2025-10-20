<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class AvatarUpload extends Component
{
    use WithFileUploads;

    public $avatar;
    public $currentAvatar;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->currentAvatar = $this->user->avatar_url;
    }

    /**
     * Upload and save the new avatar.
     */
    public function uploadAvatar(): void
    {
        $this->validate([
            'avatar' => ['required', 'image', 'max:2048'], // 2MB max
        ]);

        $user = $this->user;

        // Delete old avatar if it exists and is not the default
        if ($user->avatar_path && Storage::disk('public')->exists('avatars/' . $user->avatar_path)) {
            Storage::disk('public')->delete('avatars/' . $user->avatar_path);
        }

        // Store the new avatar into 'avatars' folder on public disk and save only the filename
        $path = $this->avatar->store('avatars', 'public');
        $filename = basename($path);

        // Update user record with normalized filename
        $user->update([
            'avatar_path' => $filename,
        ]);

        // Update component state
        $this->currentAvatar = $user->avatar_url;
        $this->avatar = null;

        $this->dispatch('avatar-updated');
        
        session()->flash('avatar-status', 'Avatar updated successfully!');
    }

    /**
     * Remove the current avatar.
     */
    public function removeAvatar(): void
    {
        $user = $this->user;

        // Delete avatar file if it exists
        if ($user->avatar_path && Storage::disk('public')->exists('avatars/' . $user->avatar_path)) {
            Storage::disk('public')->delete('avatars/' . $user->avatar_path);
        }

        // Clear avatar path from user
        $user->update([
            'avatar_path' => null,
        ]);

        // Update component state
        $this->currentAvatar = $user->avatar_url;
        $this->avatar = null;

        $this->dispatch('avatar-removed');
        
        session()->flash('avatar-status', 'Avatar removed successfully!');
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
        return view('livewire.profile.avatar-upload');
    }
}