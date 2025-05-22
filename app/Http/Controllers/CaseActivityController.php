<?php

namespace App\Http\Controllers;

use App\Models\CaseActivity;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CaseActivityController extends Controller
{
    public function index()
    {
        return CaseActivity::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'case_id' => 'required|exists:cases,id',
            'activity_type' => [
                'required',
                Rule::in(CaseActivity::ACTIVITY_TYPES),
            ],
            'user_id' => 'nullable|exists:users,id',
            'description' => 'required|string',
            'metadata' => 'nullable|array',
        ]);

        $caseActivity = CaseActivity::create($validated);

        return response()->json($caseActivity, 201);
    }

    public function show(CaseActivity $caseActivity)
    {
        return $caseActivity;
    }

    public function update(Request $request, CaseActivity $caseActivity)
    {
        $validated = $request->validate([
            'case_id' => 'sometimes|exists:cases,id',
            'activity_type' => [
                'sometimes',
                Rule::in(CaseActivity::ACTIVITY_TYPES),
            ],
            'user_id' => 'nullable|exists:users,id',
            'description' => 'sometimes|string',
            'metadata' => 'nullable|array',
        ]);

        $caseActivity->update($validated);

        return response()->json($caseActivity, 200);
    }

    public function destroy(CaseActivity $caseActivity)
    {
        $caseActivity->delete();

        return response()->json(null, 204);
    }
}
