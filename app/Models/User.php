<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'name', // Keep for backward compatibility, will be computed from first_name + last_name
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'sponsor_id',
        'phone',
    'avatar',
    'avatar_path',
        'city',
        'province_state',
        'country',
        'postal_code',
        'timezone',
        'best_contact_times',
        'profile_completed',
        'member_status',
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
            'best_contact_times' => 'array',
            'profile_completed' => 'boolean',
        ];
    }

    /**
     * Relationships
     */
    
    /**
     * Get the user's sponsor (the member who sponsored them).
     */
    public function sponsor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sponsor_id');
    }

    /**
     * Get all users sponsored by this user.
     */
    public function sponsoredMembers(): HasMany
    {
        return $this->hasMany(User::class, 'sponsor_id');
    }

    /**
     * Get recruits created by this user.
     */
    public function createdRecruits(): HasMany
    {
        return $this->hasMany(Recruit::class, 'created_by');
    }

    /**
     * Get recruits mentored by this user.
     */
    public function mentoredRecruits(): HasMany
    {
        return $this->hasMany(Recruit::class, 'mentor_id');
    }

    /**
     * Accessors & Mutators
     */

    /**
     * Get the user's full name.
     */
    public function getFullNameAttribute(): string
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    /**
     * Get the user's display name (username or full name).
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->username ?: $this->full_name;
    }

    /**
     * Get the user's location string.
     */
    public function getLocationAttribute(): string
    {
        $parts = array_filter([
            $this->city,
            $this->province_state,
            $this->country
        ]);
        
        return implode(', ', $parts);
    }

    /**
     * Get the user's avatar URL.
     */
    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar_path) {
            return asset('storage/' . $this->avatar_path);
        }

        // Generate initials-based avatar as fallback
        $initials = '';
        if ($this->first_name) $initials .= substr($this->first_name, 0, 1);
        if ($this->last_name) $initials .= substr($this->last_name, 0, 1);
        
        return 'https://ui-avatars.com/api/?name=' . urlencode($initials ?: ($this->username ?: $this->name)) . '&color=7F9CF5&background=EBF4FF';
    }

    /**
     * Get member status with proper formatting.
     */
    public function getMemberStatusLabelAttribute(): string
    {
        return match($this->member_status) {
            'pending' => 'Pending Approval',
            'active' => 'Active Member',
            'inactive' => 'Inactive',
            'suspended' => 'Suspended',
            default => 'Unknown'
        };
    }

    /**
     * Get member status color for UI.
     */
    public function getMemberStatusColorAttribute(): string
    {
        return match($this->member_status) {
            'pending' => 'yellow',
            'active' => 'green',
            'inactive' => 'gray',
            'suspended' => 'red',
            default => 'gray'
        };
    }

    /**
     * Automatically update name field when first_name or last_name changes.
     */
    protected static function booted(): void
    {
        static::saving(function (User $user) {
            if ($user->first_name || $user->last_name) {
                $user->name = $user->full_name;
            }
        });
    }

    /**
     * Scopes
     */

    /**
     * Scope to get active members only.
     */
    public function scopeActive($query)
    {
        return $query->where('member_status', 'active');
    }

    /**
     * Scope to get members with completed profiles.
     */
    public function scopeProfileCompleted($query)
    {
        return $query->where('profile_completed', true);
    }

    /**
     * Scope to get members by location.
     */
    public function scopeByLocation($query, $city = null, $province = null, $country = null)
    {
        return $query->when($city, fn($q) => $q->where('city', $city))
                    ->when($province, fn($q) => $q->where('province_state', $province))
                    ->when($country, fn($q) => $q->where('country', $country));
    }

    /**
     * Business Logic Methods
     */

    /**
     * Check if user can sponsor new members.
     */
    public function canSponsorMembers(): bool
    {
        return $this->member_status === 'active' && $this->profile_completed;
    }

    /**
     * Get sponsorship tree (all members in this user's downline).
     */
    public function getSponsorshipTree($levels = 3): array
    {
        $tree = [];
        $this->loadSponsorshipLevel($tree, $this->id, 1, $levels);
        return $tree;
    }

    /**
     * Helper method to load sponsorship levels recursively.
     */
    private function loadSponsorshipLevel(&$tree, $sponsorId, $currentLevel, $maxLevels)
    {
        if ($currentLevel > $maxLevels) return;

        $members = static::where('sponsor_id', $sponsorId)
                        ->with(['sponsoredMembers'])
                        ->get();

        foreach ($members as $member) {
            $tree[] = [
                'level' => $currentLevel,
                'member' => $member,
                'children' => []
            ];

            if ($currentLevel < $maxLevels) {
                $this->loadSponsorshipLevel($tree[count($tree)-1]['children'], $member->id, $currentLevel + 1, $maxLevels);
            }
        }
    }

    /**
     * Get the user's theme settings with default values.
     *
     * @return array
     */
    public function getThemeSettings(): array
    {
        return $this->theme_settings ?: [
            'theme' => 'blue-ocean',
            'primary' => '#3b82f6',
            'secondary' => '#6b7280',
            'accent' => '#22c55e',
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

    /**
     * Check if user profile is complete.
     */
    public function isProfileComplete(): bool
    {
        $requiredFields = [
            'first_name', 'last_name', 'username', 'email', 'phone',
            'city', 'province_state', 'country', 'postal_code', 'timezone'
        ];

        foreach ($requiredFields as $field) {
            if (empty($this->$field)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Mark profile as completed if all required fields are filled.
     */
    public function updateProfileCompletion(): bool
    {
        $isComplete = $this->isProfileComplete();
        
        if ($this->profile_completed !== $isComplete) {
            return $this->update(['profile_completed' => $isComplete]);
        }

        return true;
    }
}
