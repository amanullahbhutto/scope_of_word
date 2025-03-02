<?php

namespace App\Http\Controllers;

use App\Models\MonitoringRequest; // Adjust the model name if it's different
use Illuminate\Http\Request as HttpRequest;

use App\Models\RequestModel; // Replace with your actual model
use Illuminate\Http\Request;
use App\Models\User; //adopted_schools
use App\Models\Adopted_schools;

class MonitoringController extends Controller
{
    /**
     * Display all the requests.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve all requests
        $requests = MonitoringRequest::all();

        return view('admin.monitrering.index', compact('requests'));
    }

    /**
     * Display pending requests.
     *
     * @return \Illuminate\View\View
     */
    public function pending()
    {
        // Retrieve only pending requests
        $requests = MonitoringRequest::where('status', 'pending')->get();

        return view('admin.monitrering.pending', compact('requests'));
    }

    /**
     * Display accepted requests.
     *
     * @return \Illuminate\View\View
     */
    public function accepted()
    {
        // Retrieve only accepted requests
        $requests = MonitoringRequest::where('status', 'accepted')->get();

        return view('admin.monitrering.approved', compact('requests'));
    }

    /**
     * Display rejected requests.
     *
     * @return \Illuminate\View\View
     */
    public function rejected()
    {
        // Retrieve only rejected requests
        $requests = MonitoringRequest::where('status', 'rejected')->get();

        return view('admin.monitrering.rejected', compact('requests'));
    }

    public function show($id)
    {
        // Fetch the MonitoringRequest with the associated school and region
        $request = MonitoringRequest::with(['school', 'region', 'district','tehsil'])->findOrFail($id);
    
        // Return the view with the request data, including school and region
        return view('admin.monitrering.show', compact('request'));
    }

    public function add_user(Request $request, $id)
{
    // Step 1: Validate the incoming request data
    $validatedData = $request->validate([
        'full_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email', // Email must be unique
        'phone' => 'required|string|max:255',
        'region_id' => 'required|integer',
        'district_id' => 'required|integer',
        'tehsil_id' => 'required|integer',
        'school_id' => 'required|integer',
        'otp' => 'required|string|max:255',
        'address' => 'required|string',
        'status' => 'required|string|in:pending,approved,rejected',
        'password' => 'required|min:8', // Password must be confirmed
    ]);

    // Step 2: Create a new user in the users table
    $user = User::create([
        'name' => $validatedData['full_name'],
        'email' => $validatedData['email'],
        'phone' => $validatedData['phone'],
        'region_id' => $validatedData['region_id'],
        'district_id' => $validatedData['district_id'],
        'tehsil_id' => $validatedData['tehsil_id'],
        'school_id' => $validatedData['school_id'],
        'otp' => $validatedData['otp'],
        'address' => $validatedData['address'],
        'password' => bcrypt($validatedData['password']), // Encrypt password
    ]);

    // Step 3: Add a record in the adopted_schools table
    Adopted_schools::create([
        'user_id' => $user->id, // Link adopted school to the newly created user
        'school_id' => $validatedData['school_id'],
    ]);

    // Step 4: Find the MonitoringRequest by ID and update its status
    $monitoringRequest = MonitoringRequest::find($id);
    if ($monitoringRequest) {
        $monitoringRequest->update([
            'status' => $validatedData['status'],
        ]);

        // Step 5: Redirect with a success message
        return redirect()
            ->route('monitoring.pending')
            ->with('success', 'User and adopted school created successfully, and monitoring request updated.');
    }

    // If MonitoringRequest not found, redirect back with an error
    return back()->with('error', 'Monitoring request not found.');
}

    
    
}
