<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
    use HasFactory;

    // Allowed values for case status, death type, and burial type
    public const CASE_STATUSES = [
        'new', 'pending_verification', 'in_progress', 'pending_documents', 'pending_approval',
        'approved', 'in_transit', 'completed', 'cancelled', 'on_hold'
    ];

    public const DEATH_TYPES = [
        'natural', 'accident', 'hospital', 'other'
    ];

    public const BURIAL_TYPES = [
        'local', 'repatriation'
    ];

    protected $fillable = [
        'reference_number',
        'status',
        'death_type',
        'burial_type',
        'deceased_details',
        'death_details',
        'relative_details',
        'location_details',
        'insurance_details',
        'repatriation_details',
        'assigned_insurance_id',
        'assigned_dispatcher_id',
        'assigned_funeral_service_id',
        'assigned_expeditor_id',
        'assigned_hospital_id',
        'assigned_mosque_id',
        'assigned_mortuary_id',
        'created_by',
        'estimated_completion_date',
        'completed_at',
        'cancelled_at',
        'cancellation_reason',
        'notes'
    ];

    protected $casts = [
        'deceased_details' => 'array',
        'death_details' => 'array',
        'relative_details' => 'array',
        'location_details' => 'array',
        'insurance_details' => 'array',
        'repatriation_details' => 'array',
    ];

    public function assignedInsurance()
{
    return $this->belongsTo(User::class, 'assigned_insurance_id');
}

public function assignedDispatcher()
{
    return $this->belongsTo(User::class, 'assigned_dispatcher_id');
}

public function assignedFuneralService()
{
    return $this->belongsTo(User::class, 'assigned_funeral_service_id');
}

public function assignedExpeditor()
{
    return $this->belongsTo(User::class, 'assigned_expeditor_id');
}

public function assignedHospital()
{
    return $this->belongsTo(User::class, 'assigned_hospital_id');
}

public function assignedMosque()
{
    return $this->belongsTo(User::class, 'assigned_mosque_id');
}

public function assignedMortuary()
{
    return $this->belongsTo(User::class, 'assigned_mortuary_id');
}
}
