<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'theme_settings',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'theme_settings' => 'array',
        ];
    }

    /**
     * Get the user's theme settings with default values.
     *
     * @return array
     */
    public function getThemeSettings(): array
    {
        return $this->theme_settings ?: [
            'primary' => '#3b82f6',   // blue-500
            'secondary' => '#6b7280', // gray-500
            'accent' => '#22c55e',    // green-500
        ];
    }

    /**
     * Update the user's theme settings.
     *
     * @param array $settings
     * @return bool
     */
    public function updateThemeSettings(array $settings): bool
    {
        return $this->update(['theme_settings' => $settings]);
    }
}
