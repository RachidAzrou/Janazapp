<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuditLogRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Update with authorization logic if needed
    }

    public function rules()
    {
        return [
            'user_id' => 'nullable|exists:users,id',
            'action' => 'required|string|max:50',
            'entity_type' => 'nullable|string|max:50',
            'entity_id' => 'nullable|integer',
            'old_values' => 'nullable|array',
            'new_values' => 'nullable|array',
            'ip_address' => 'nullable|ip',
            'user_agent' => 'nullable|string',
        ];
    }
}
