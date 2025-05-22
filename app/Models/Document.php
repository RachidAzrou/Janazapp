<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'case_id',
        'type',
        'file_path',
        'original_filename',
        'mime_type',
        'file_size',
        'uploaded_by',
        'status',
        'verification_notes',
        'verified_by',
        'verified_at',
        'expires_at',
        'metadata'
    ];

    // Enum values for type and status
    const TYPES = [
        'death_certificate', 'medical_report', 'passport', 'id_card', 'insurance_policy',
        'burial_permit', 'transit_permit', 'embassy_approval', 'police_report',
        'morgue_release', 'flight_ticket', 'other'
    ];

    const STATUSES = [
        'pending', 'uploaded', 'verified', 'rejected', 'expired'
    ];

    public function case()
    {
        return $this->belongsTo(Cases::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}

