<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Recruit extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name', 
        'email',
        'phone',
        'birth_date',
        'address',
        'city',
        'state',
        'zip_code',
        'emergency_contact_name',
        'emergency_contact_phone',
        'status',
        'license_number',
        'license_date',
        'license_expiry',
        'licensing_progress',
        'mentor_id',
        'start_date',
        'expected_completion_date',
        'onboarding_completion_percentage',
        'training_completion_percentage',
        'completed_modules',
        'notes',
        'tags',
        'calls_made',
        'appointments_set',
        'appointments_held',
        'applications_submitted',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'license_date' => 'date',
        'license_expiry' => 'date',
        'start_date' => 'date',
        'expected_completion_date' => 'date',
        'licensing_progress' => 'array',
        'completed_modules' => 'array',
        'tags' => 'array',
    ];

    /**
     * Relationships
     */
    public function mentor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Accessors
     */
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'prospect' => 'Prospect',
            'applied' => 'Applied',
            'interviewing' => 'Interviewing',
            'onboarding' => 'Onboarding',
            'training' => 'In Training',
            'licensed' => 'Licensed',
            'active' => 'Active',
            'inactive' => 'Inactive',
            'terminated' => 'Terminated',
            default => 'Unknown'
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'prospect' => 'gray',
            'applied' => 'blue',
            'interviewing' => 'yellow',
            'onboarding' => 'purple',
            'training' => 'indigo',
            'licensed' => 'green',
            'active' => 'emerald',
            'inactive' => 'orange',
            'terminated' => 'red',
            default => 'gray'
        };
    }

    /**
     * Scopes
     */
    public function scopeActive($query)
    {
        return $query->where('status', '!=', 'terminated');
    }

    public function scopeByMentor($query, $mentorId)
    {
        return $query->where('mentor_id', $mentorId);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
