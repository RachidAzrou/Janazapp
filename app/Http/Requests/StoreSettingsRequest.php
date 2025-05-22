<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSettingsRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Update with authorization logic if needed
    }

    public function rules()
    {
        return [
            'key' => 'required|string|max:255|unique:settings,key',
            'value' => 'nullable|string',
            'description' => 'nullable|string',
            'is_public' => 'required|boolean',
        ];
    }
}
