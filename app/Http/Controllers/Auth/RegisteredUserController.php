<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Organization;
use App\Models\UserRole;
use App\Models\UserStatus;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $userRole = UserRole::where('role_name', 'user')->first();
        $userStatus = UserStatus::where('status_name', 'pending_verification')->first();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $userRole ? $userRole->id : null,
            'user_status_id' => $userStatus ? $userStatus->id : null,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    public function update(Request $request, User $user)
{
    // Validate and update the user
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'phone' => 'nullable|string',
        // Add more validation rules if needed
    ]);

    // Update the user data
    $user->update($request->only('name', 'email', 'phone', 'whatsapp_id', 'role_id', 'organization'));

    return redirect()->route('users.details', $user);
}

    public function list(Request $request)
{
    $roles = UserRole::all();
    $statuses = UserStatus::all();
    // Build the query
    $query = User::with(['role', 'status']);

    // Apply search filter
    if ($search = $request->input('search')) {
        $query->where('name', 'like', "%$search%")
              ->orWhere('email', 'like', "%$search%");
    }

    // Apply status filter (if provided)
    if ($request->filled('statusFiltered')) {
        $query->whereHas('status', function ($query) use ($request) {
            $query->where('status_name', $request->statusFiltered);
        });
    }

    // Paginate results
    $users = $query->paginate(10)->appends($request->query());

    // Return paginated users
    return Inertia::render('Users/Index', [
        'users' => $users,
        'roles' => $roles,
        'statuses' => $statuses,
        'filters' => $request->only('search', 'statusFiltered'), // Send search filter back to frontend
    ]);
}

public function detailsUser($id) {
    // Fetch the user by ID to pass to the Inertia page
    $user = User::with(['role', 'status', 'organization'])->findOrFail($id);
    return Inertia::render('Users/Details', [
        'user' => $user
    ]);
}
public function postEditUser(Request $request) {
    $userdata = $request->input('data');
    $user = User::find($userdata['id']);

    $request->validate([
        'data.name' => 'required|string|max:255',
        'data.email' => 'required|email|unique:users,email,' . $userdata['id'],
        'data.phone' => 'nullable|string',
        'data.whatsapp_id' => 'nullable|string',
        'data.role_id' => 'nullable|int',
        'data.organization_id' => 'nullable|int',
    ]);

    if ($user) {
        $user->name = $userdata['name'];
        $user->email = $userdata['email'];
        $user->phone = $userdata['phone'];
        $user->whatsapp_id = $userdata['whatsapp_id'];
        $user->role_id = $userdata['role_id'];
        $user->organization_id = $userdata['organization_id'];
        $user->save();
    }

    return Inertia::location('/users/' . $user->id . '/details');
}

    public function getEditUser($id) {
        // Fetch the user by ID to pass to the Inertia page
        $user = User::with(['role', 'status', 'organization'])->findOrFail($id);
        $roles = UserRole::all();
        $organizations = Organization::all();
        return Inertia::render('Users/Edit', props: [
            'user' => $user,
            'roles' => $roles,
            'organizations' => $organizations,
        ]);
    }
}
