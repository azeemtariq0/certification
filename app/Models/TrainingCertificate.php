<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingCertificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'certificate_no',
        'verification_id',
        'candidate_name',
        'candidate_id',
        'course_title',
        'course_category',
        'standard',
        'training_duration',
        'training_provider',
        'issuing_organization',
        'completion_date',
        'issue_date',
        'valid_until',
        'status',
        'certificate_file',
        'remarks',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'completion_date' => 'date',
        'issue_date' => 'date',
        'valid_until' => 'date',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function getStatusBadgeAttribute(): string
    {
        return match (strtoupper($this->status)) {
            'VALID' => 'success',
            'EXPIRED' => 'warning',
            'CANCELLED' => 'secondary',
            'SUSPENDED' => 'warning',
            'REVOKED' => 'danger',
            default => 'info',
        };
    }

    public function getQrVerificationUrlAttribute(): string
    {
        return url('/verify/training/' . $this->verification_id);
    }
}
