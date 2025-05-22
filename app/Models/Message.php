<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class Message extends Model
{
    protected $fillable = [
        'case_id',
        'sender_id',
        'receiver_id',
        'message_type',
        'content',
        'metadata',
        'status',
        'read_at',
        'delivered_at',
    ];

    // Validation rules for message_type and status
    const VALID_MESSAGE_TYPES = [
        'chat',
        'email',
        'sms',
        'whatsapp',
        'system_notification',
    ];

    const VALID_STATUS = [
        'sent',
        'delivered',
        'read',
        'failed',
    ];

    // Automatically validate on creating/updating
    protected static function booted()
    {
        static::saving(function ($message) {
            // Validate message_type
            $validator = Validator::make($message->attributes, [
                'message_type' => [
                    'required',
                    Rule::in(self::VALID_MESSAGE_TYPES),
                ],
                'status' => [
                    'required',
                    Rule::in(self::VALID_STATUS),
                ],
            ]);

            // If validation fails, throw an exception
            if ($validator->fails()) {
                throw new \Illuminate\Validation\ValidationException($validator);
            }
        });
    }
}
