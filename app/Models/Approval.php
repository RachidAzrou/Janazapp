<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;

    protected $fillable = [
        'case_id',
        'approval_type',
        'requested_by',
        'approved_by',
        'status',
        'notes',
        'requested_at',
        'approved_at',
        'rejected_at',
        'rejection_reason',
    ];

    const VALID_STATUSES = ['pending', 'approved', 'rejected'];

    protected static function booted()
    {
        static::saving(function ($approval) {
            // Ensure status is valid
            if (!in_array($approval->status, self::VALID_STATUSES)) {
                throw new \InvalidArgumentException('Invalid status.');
            }
        });
    }

    public function case()
    {
        return $this->belongsTo(Cases::class);
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
