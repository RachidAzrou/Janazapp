<?php

namespace App\Http\Controllers;

use App\Models\ServiceSchedule;
use Illuminate\Http\Request;

class ServiceScheduleController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'case_id' => 'required|exists:cases,id',
            'service_type' => 'required|string|max:50',
            'location_id' => 'required|exists:organizations,id',
            'scheduled_start' => 'required|date',
            'scheduled_end' => 'required|date|after_or_equal:scheduled_start',
            'status' => 'required|in:scheduled,completed,cancelled,pending',
            'notes' => 'nullable|string',
            'created_by' => 'nullable|exists:users,id',
            'updated_by' => 'nullable|exists:users,id',
            'completed_at' => 'nullable|date',
        ]);

        $serviceSchedule = ServiceSchedule::create($validated);

        return response()->json($serviceSchedule, 201);
    }
}
