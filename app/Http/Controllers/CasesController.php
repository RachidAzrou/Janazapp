<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use App\Models\CaseActivity;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CasesController extends Controller
{
    public function create()
    {
        return Inertia::render('Cases/Create');
    }

    /**
     * Store a newly created organization in storage.
     */

     public function store(Request $request)
     {
         $validated = $request->validate([
             'deceased_name' => 'required|string|max:255',
             'deceased_age' => 'required|integer|min:0|max:150',
             'deceased_gender' => 'required|string|in:male,female',
             'death_type' => 'required|string|in:natural,accident,hospital,other',
             'burial_type' => 'required|string|in:local,repatriation',
             'destination' => 'nullable|required_if:burial_type,repatriation|string|max:255',
             'expected_date' => 'nullable|required_if:burial_type,repatriation|date',
             'cause' => 'required|string|max:255',
             'date' => 'required|date',
             'notes' => 'nullable|string|max:5000',
         ]);
     
             // Save the case in the database
             $case = new Cases();
     
             $case->reference_number = Str::random(10);
             
             // Handle deceased_details as an array
             $deceasedDetails = [
                 'name' => $validated['deceased_name'],
                 'age' => $validated['deceased_age'],
                 'gender' => $validated['deceased_gender'],
             ];
             $case->deceased_details = $deceasedDetails;
             if (isset($validated['destination']) && isset($validated['expected_date'])) {
                $repatriationDetails = [
                    'destination' => $validated['destination'],
                    'expected_date' => $validated['expected_date'],
                ];
                $case->repatriation_details = $repatriationDetails;
            }
            $deathDetails = [
                'cause' => $validated['cause'],
                'date' => $validated['date'],
            ];
            $case->death_details = $deathDetails;
     
             // Assign other attributes
             $case->death_type = $validated['death_type'];
             $case->burial_type = $validated['burial_type'];
             $case->notes = $validated['notes'] ?? null;
     
             $case->save();
     
             return response()->json([
                 'success' => true,
                 'message' => 'Case created successfully!',
                 'reference_number' => $case->reference_number,
             ]);
     }

    public function list(Request $request)
    {
        // Build the query
        $cases = Cases::query();

        // Apply search filter
        if ($search = $request->input('search')) {
            $cases->where('reference_number', 'like', "%$search%")->orWhere('created_by', 'like', "%$search%");
        }

        //apply filter status
        if ($request->filled('statusFiltered')) {
            $cases->where('status', $request->statusFiltered);
        }

        // Paginate results
        $cases = $cases->paginate(10)->appends($request->query());

        // Return paginated organizations
        return Inertia::render('Cases/Index', [
            'cases' => $cases,
            'filters' => $request->only('search', 'statusFiltered'), // Send search filter back to frontend
        ]);
    }

    public function detailsCase($id)
    {
        $user = User::select(['id', 'name'])->get();
        $cases = Cases::with(['assignedInsurance.role', 'assignedDispatcher.role', 'assignedFuneralService.role', 'assignedExpeditor.role', 'assignedHospital.role', 'assignedMosque.role', 'assignedMortuary.role'])->findOrFail($id);
        $caseActivities = CaseActivity::where('case_id', 'is', $id)->get();
        return Inertia::render('Cases/Details', [
            'cases' => $cases,
            'caseActivities' => $caseActivities,
            'users' => $user,
        ]);
    }

    public function getEditCase($id)
    {
        $cases = Cases::with(['assignedInsurance.role', 'assignedDispatcher.role', 'assignedFuneralService.role', 'assignedExpeditor.role', 'assignedHospital.role', 'assignedMosque.role', 'assignedMortuary.role'])->findOrFail($id);
        $statuses = Cases::select('status')->distinct()->pluck('status');
        $burialTypes = Cases::select('burial_type')->distinct()->pluck('burial_type');
        $deathTypes = Cases::select('death_type')->distinct()->pluck('death_type');

        return Inertia::render(
            'Cases/Edit',
            props: [
                'cases' => $cases,
                'statuses' => $statuses,
                'burialTypes' => $burialTypes,
                'deathTypes' => $deathTypes,
            ],
        );
    }

    public function postEditCase(Request $request, $id)
    {
        $userdata = $request->all();
        $cases = Cases::find($userdata['id']);

        // Validation
        $statuses = ['new', 'pending_verification', 'in_progress', 'pending_documents', 'pending_approval', 'approved', 'in_transit', 'completed', 'cancelled', 'on_hold'];
        $deathTypes = ['natural', 'accident', 'hospital', 'other'];

        $request->validate([
            'status' => ['required', Rule::in($statuses)],
            'burial_type' => 'required|in:repatriation,local',
            'estimated_completion_date' => 'nullable|date',
            'completed_at' => 'nullable|date',
            'cancelled_at' => 'nullable|date',
            'cancellation_reason' => 'nullable|string',
            'deceased_details.name' => 'required|string',
            'deceased_details.age' => 'required|integer',
            'deceased_details.gender' => 'required|in:male,female',
            'death_type' => ['required', Rule::in($deathTypes)],
            'death_details.cause' => 'required|string',
            'death_details.date' => 'required|date',
            'location_details.city' => 'required|string',
            'location_details.country' => 'required|string',
            'insurance_details.policy_number' => 'required|string',
            'insurance_details.provider' => 'required|string',
            'repatriation_details.destination' => 'required|string',
            'repatriation_details.expected_date' => 'required|date',
            'assigned_insurance.name' => 'required|string',
            'assigned_dispatcher.name' => 'required|string',
            'assigned_funeral_service.name' => 'required|string',
            'assigned_expeditor.name' => 'required|string',
            'assigned_hospital.name' => 'required|string',
            'assigned_mosque.name' => 'required|string',
            'assigned_mortuary.name' => 'required|string',
        ]);

        // Save the old data if needed
        $oldData = $cases->getOriginal();

        // Update case fields
        $cases->status = $userdata['status'];
        $cases->burial_type = $userdata['burial_type'];
        $cases->estimated_completion_date = $userdata['estimated_completion_date'];
        $cases->completed_at = $userdata['completed_at'];
        $cases->cancelled_at = $userdata['cancelled_at'];
        $cases->cancellation_reason = $userdata['cancellation_reason'];

        // Update nested fields if applicable
        $cases->deceased_details = $userdata['deceased_details'];
        $cases->death_details = $userdata['death_details'];
        $cases->location_details = $userdata['location_details'];
        $cases->insurance_details = $userdata['insurance_details'];
        $cases->repatriation_details = $userdata['repatriation_details'];
        $cases->assigned_insurance_id = $userdata['assigned_insurance']['id'];
        $cases->assigned_dispatcher_id = $userdata['assigned_dispatcher']['id'];
        $cases->assigned_funeral_service_id = $userdata['assigned_funeral_service']['id'];
        $cases->assigned_expeditor_id = $userdata['assigned_expeditor']['id'];
        $cases->assigned_hospital_id = $userdata['assigned_hospital']['id'];
        $cases->assigned_mosque_id = $userdata['assigned_mosque']['id'];
        $cases->assigned_mortuary_id = $userdata['assigned_mortuary']['id'];

        // Save the updated case
        $cases->save();

        // Create a new activity log with the chanegd stuff inside metadata.
        $changedData = $cases->getChanges();
        if (!empty($changedData)) {
            CaseActivity::create([
                'case_id' => $cases->id,
                'user_id' => Auth::id(),
                'activity_type' => 'Modified',
                'description' => 'Updated case details',
                'metadata' => json_encode([
                    'old' => array_intersect_key($oldData, $changedData),
                    'new' => $changedData,
                ]),
            ]);
        }

        return Inertia::location('/cases/' . $cases->id . '/details');
    }

    public function destroy(Cases $case)
    {
        $case->delete();
        return response()->noContent();
    }
}
