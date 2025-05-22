<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApprovalRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Set to true or add authorization logic
    }

    public function rules()
    {
        return [
            'case_id' => 'required|exists:cases,id',
            'approval_type' => 'required|string|max:50',
            'requested_by' => 'required|exists:users,id',
            'approved_by' => 'nullable|exists:users,id',
            'status' => 'required|in:pending,approved,rejected',
            'notes' => 'nullable|string',
            'requested_at' => 'nullable|date',
            'approved_at' => 'nullable|date',
            'rejected_at' => 'nullable|date',
            'rejection_reason' => 'nullable|string',
        ];
    }
}
