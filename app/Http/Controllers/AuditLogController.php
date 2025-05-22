<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuditLogRequest;
use App\Models\AuditLog;

class AuditLogController extends Controller
{
    public function index()
    {
        return AuditLog::latest()->paginate(15);
    }

    public function store(StoreAuditLogRequest $request)
    {
        $auditLog = AuditLog::create($request->validated());
        return response()->json($auditLog, 201);
    }

    public function show(AuditLog $auditLog)
    {
        return $auditLog;
    }
}
