<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    // Define the fillable attributes for the model
    protected $fillable = [
        'name',
        'type',
        'registration_number',
        'tax_number',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'postal_code',
        'country',
        'phone',
        'email',
        'website',
        'operating_hours',
        'user_status_id',
        'verification_status',
        'verified_at',
        'settings',
    ];

    // You can use constants for organization types if necessary
    const INSURANCE_COMPANY = 'insurance_company';
    const FUNERAL_SERVICE = 'funeral_service';
    const HOSPITAL = 'hospital';
    const MOSQUE = 'mosque';
    const MORTUARY = 'mortuary';
    const EXPEDITOR_COMPANY = 'expeditor_company';

    /**
     * Get all possible organization types.
     *
     * @return array
     */
    public static function getOrganizationTypes(): array
    {
        return [
            self::INSURANCE_COMPANY,
            self::FUNERAL_SERVICE,
            self::HOSPITAL,
            self::MOSQUE,
            self::MORTUARY,
            self::EXPEDITOR_COMPANY,
        ];
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function status()
    {
        return $this->belongsTo(UserStatus::class, 'user_status_id');
    }
}
