<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserRoleController extends Controller
{
    /**
     * Display a listing of all roles.
     */
    public function index()
    {
        // Retrieve all available roles from the User model
        $roles = User::getRoles();
        return response()->json($roles);
    }

    /**
     * Show the form for creating a new role (if applicable).
     */
    public function create()
    {
        // If there is a role creation form, return it here
        // (Typically roles are predefined, so this might not be needed)
        return view('roles.create'); // Adjust view path as necessary
    }

    /**
     * Assign a role to a new or existing user.
     */
    public function store(Request $request)
    {
        // Validate the role to ensure it’s a defined constant
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => ['required', Rule::in(User::getRoles())],
        ]);

        // Find the user and assign the role
        $user = User::findOrFail($request->user_id);
        $user->role = $request->role;
        $user->save();

        return response()->json(['message' => 'Role assigned successfully!', 'user' => $user]);
    }

    /**
     * Display the role of a specific user.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return response()->json(['user_id' => $user->id, 'role' => $user->role]);
    }

    /**
     * Show the form for editing a user's role.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = User::getRoles();

        return view('roles.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the role of a specific user.
     */
    public function update(Request $request, string $id)
    {
        // Validate that the role is valid
        $request->validate([
            'role' => ['required', Rule::in(User::getRoles())],
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return response()->json(['message' => 'Role updated successfully!', 'user' => $user]);
    }

    /**
     * Remove a user's role (if applicable).
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->role = null; // Or set to a default role if required
        $user->save();

        return response()->json(['message' => 'User role removed successfully!', 'user' => $user]);
    }
}
