<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'case_id',
        'service_type',
        'location_id',
        'scheduled_start',
        'scheduled_end',
        'status',
        'notes',
        'created_by',
        'updated_by',
        'completed_at',
    ];

    // Define possible statuses for validation
    const VALID_STATUSES = [
        'scheduled',
        'completed',
        'cancelled',
        'pending',
    ];

    protected static function booted()
    {
        static::saving(function ($serviceSchedule) {
            // Ensure status is valid
            if (!in_array($serviceSchedule->status, self::VALID_STATUSES)) {
                throw new \InvalidArgumentException('Invalid status.');
            }
        });
    }

    // protected static function booted()
    // {
    //     static::saving(function ($serviceSchedule) {
    //         // Ensure status is valid
    //         if (!in_array($serviceSchedule->status, self::VALID_STATUSES)) {
    //             throw new \Illuminate\Validation\ValidationException('Invalid status.');
    //         }
    //     });
    // }
}
