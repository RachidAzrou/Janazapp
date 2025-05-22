<?php

namespace App\Http\Controllers;

use App\Models\UserStatus;
use Illuminate\Http\Request;

class UserStatusController extends Controller
{
    /**
     * Display a listing of user statuses.
     */
    public function index()
    {
        $statuses = UserStatus::all();
        return response()->json($statuses);
    }

    /**
     * Show the form for creating a new status.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created status in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'status_name' => 'required|unique:user_statuses,status_name|max:255',
        ]);

        $status = UserStatus::create($request->all());
        return response()->json($status, 201);
    }

    /**
     * Display the specified status.
     */
    public function show(UserStatus $userStatus)
    {
        return response()->json($userStatus);
    }

    /**
     * Show the form for editing the specified status.
     */
    public function edit(UserStatus $userStatus)
    {
        //
    }

    /**
     * Update the specified status in storage.
     */
    public function update(Request $request, UserStatus $userStatus)
    {
        $request->validate([
            'status_name' => 'required|unique:user_statuses,status_name|max:255',
        ]);

        $userStatus->update($request->all());
        return response()->json($userStatus);
    }

    /**
     * Remove the specified status from storage.
     */
    public function destroy(UserStatus $userStatus)
    {
        $userStatus->delete();
        return response()->json(null, 204);
    }
}
