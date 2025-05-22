<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class TransportArrangement extends Model
{
    use HasFactory;

    protected $fillable = [
        'case_id', 'transport_type', 'provider', 'vehicle_details',
        'departure_location', 'departure_time', 'arrival_location',
        'estimated_arrival_time', 'actual_arrival_time', 'status',
        'tracking_number', 'cost_details', 'notes'
    ];

    protected $casts = [
        'vehicle_details' => 'array',
        'cost_details' => 'array',
        'departure_time' => 'datetime',
        'estimated_arrival_time' => 'datetime',
        'actual_arrival_time' => 'datetime',
    ];

    // Enum values for transport_type and status
    const VALID_TRANSPORT_TYPES = ['local', 'international', 'airport_transfer'];
    const VALID_STATUSES = ['scheduled', 'in_transit', 'arrived', 'canceled'];

    protected static function booted()
    {
        static::saving(function ($transportArrangement) {
            if (!in_array($transportArrangement->transport_type, self::VALID_TRANSPORT_TYPES)) {
                throw new InvalidArgumentException('Invalid transport type.');
            }
            if (!in_array($transportArrangement->status, self::VALID_STATUSES)) {
                throw new InvalidArgumentException('Invalid status.');
            }
        });
    }
}
