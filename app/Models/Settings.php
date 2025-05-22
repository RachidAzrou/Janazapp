<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'description',
        'is_public',
    ];

    protected static function booted()
    {
        static::saving(function ($setting) {
            // Ensure the key is unique
            if (self::where('key', $setting->key)->where('id', '!=', $setting->id)->exists()) {
                throw new \InvalidArgumentException('The key must be unique.');
            }
        });
    }
}
