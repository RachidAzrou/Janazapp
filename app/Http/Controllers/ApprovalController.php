<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApprovalRequest;
use App\Models\Approval;

class ApprovalController extends Controller
{
    public function index()
    {
        return Approval::all();
    }

    public function store(StoreApprovalRequest $request)
    {
        $approval = Approval::create($request->validated());
        return response()->json($approval, 201);
    }

    public function show(Approval $approval)
    {
        return $approval;
    }

    public function update(StoreApprovalRequest $request, Approval $approval)
    {
        $approval->update($request->validated());
        return response()->json($approval, 200);
    }

    public function destroy(Approval $approval)
    {
        $approval->delete();
        return response()->noContent();
    }
}
