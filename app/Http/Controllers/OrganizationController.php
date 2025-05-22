<?php

namespace App\Http\Controllers;

use App\Models\UserStatus;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrganizationController extends Controller
{
    /**
     * Show the form for creating a new organization.
     */
    public function create()
    {
        return Inertia::render('Organizations/Create');
    }

    /**
     * Store a newly created organization in storage.
     */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'registration_number' => 'required|string|max:255',
            'tax_number' => 'required|string|max:255',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'website' => 'nullable|url|max:255',
        ]);

        $userStatus = UserStatus::where('status_name', 'pending_verification')->first();

        // Merge the validated data with the 'user_status_id'
        $organization = Organization::create(
            array_merge($validated, [
                'user_status_id' => $userStatus ? $userStatus->id : null,
            ]),
        );

        if ($organization && $validated) {
            return response()->json([
                'success' => true,
                'message' => 'Organization created successfully!',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create organization',
            ]);
        }
    }

    /**
     * Show the form for editing the specified organization.
     */
    public function edit(Organization $organization)
    {
        return Inertia::render('organizations.edit', compact('organization'));
    }

    /**
     * Remove the specified organization from storage.
     */
    public function delete($id)
    {
        // Find the organization
        $organization = Organization::findOrFail($id);

        // Update users to nullify the organization_id
        User::where('organization_id', $organization->id)->update(['organization_id' => null]);

        // Delete the organization
        $organization->forceDelete();

        // Redirect with success message
        return redirect()->route('organizations')->with('success', 'Organization deleted successfully!');
    }

    /**
     * Display a listing of the organizations.
     */
    public function list(Request $request)
    {
        $statuses = UserStatus::all();
        // Build the query
        $query = Organization::with(['status']);

        // Apply search filter
        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%$search%")->orWhere('email', 'like', "%$search%");
        }

        // Apply status filter (if provided)
        if ($request->filled('statusFiltered')) {
            $query->whereHas('status', function ($query) use ($request) {
                $query->where('status_name', $request->statusFiltered); // Adjust column name as needed
            });
        }

        // Paginate results
        $organizations = $query->paginate(10)->appends($request->query());

        // Return paginated organizations
        return Inertia::render('Organizations/Index', [
            'organizations' => $organizations,
            'statuses' => $statuses,
            'filters' => $request->only('search', 'statusFiltered'), // Send search filter back to frontend
        ]);
    }

    /**
     * Display the specified organization.
     */
    public function detailsOrganization($id)
    {
        // Fetch the user by ID to pass to the Inertia page
        $organization = Organization::with('status')->findOrFail($id);
        return Inertia::render('Organizations/Details', [
            'organization' => $organization,
        ]);
    }

    public function getEditOrganization($id)
    {
        // Fetch the user by ID to pass to the Inertia page
        $organization = Organization::with(['status'])->findOrFail($id);
        return Inertia::render(
            'Organizations/Edit',
            props: [
                'organization' => $organization,
            ],
        );
    }

    public function postEditOrganization(Request $request)
    {
        $userdata = $request->input('data');
        $organization = Organization::find($userdata['id']);

        $request->validate([
            'data.name' => 'required|string|max:255',
            'data.email' => 'required|email|unique:users,email,' . $userdata['id'],
            'data.phone' => 'nullable|string',
            'data.type' => 'nullable|string',
            'data.registration_number' => 'nullable|string',
            'data.tax_number' => 'nullable|string',
            'data.website' => 'nullable|string',
            'data.address_line1' => 'nullable|string',
            'data.address_line2' => 'nullable|string',
            'data.city' => 'nullable|string',
            'data.state' => 'nullable|string',
            'data.postal_number' => 'nullable|string',
            'data.country' => 'nullable|string',
        ]);

        if ($organization) {
            $organization->name = $userdata['name'];
            $organization->email = $userdata['email'];
            $organization->phone = $userdata['phone'];
            $organization->type = $userdata['type'];
            $organization->registration_number = $userdata['registration_number'];
            $organization->tax_number = $userdata['tax_number'];
            $organization->website = $userdata['website'];
            $organization->address_line1 = $userdata['address_line1'];
            $organization->address_line2 = $userdata['address_line2'];
            $organization->city = $userdata['city'];
            $organization->state = $userdata['state'];
            $organization->postal_code = $userdata['postal_code'];
            $organization->country = $userdata['country'];
            $organization->save();
        }

        return Inertia::location('/organizations/' . $organization->id . '/details');
    }

    public function showUsers(Organization $organization)
{
    $users = $organization->users;  // Retrieve all users related to the organization

    return Inertia::render('Organizations/Users', [
        'organization' => $organization,
        'users' => $users,
    ]);
}
}
