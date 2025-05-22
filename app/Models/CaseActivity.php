<?php

// app/Models/CaseActivity.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseActivity extends Model
{
    use HasFactory;

    // Enum constants for activity types
    public const ACTIVITY_TYPES = [
        'case_created',
        'status_changed',
        'document_uploaded',
        'document_verified',
        'assignment_changed',
        'note_added',
        'message_sent',
        'approval_requested',
        'approval_granted',
        'service_scheduled',
        'service_completed',
        'transport_arranged',
        'relative_notification',
    ];

    protected $fillable = [
        'case_id',
        'activity_type',
        'user_id',
        'description',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    public function case()
    {
        return $this->belongsTo(Cases::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
