<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Models\MonitoringRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class OtpController extends Controller
{
    // Send OTP
    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422); // 422 Unprocessable Entity
        }


        $otp = rand(100000, 999999); // Generate a random 6-digit OTP

        // Store OTP in session (or database for production use)
        Session::put('otp', $otp);
        Session::put('otp_email', $request->email);

        // Send OTP email
        Mail::send('emails.otp', ['otp' => $otp], function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Your OTP Code');
        });

        return response()->json([
            'success' => true,
            'message' => 'OTP sent to your email!',
        ]);
    }

    // Verify OTP
    public function verifyOtp(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'otp' => 'required|numeric',
            'email' => 'required|email',
        ]);
      
        $sessionOtp = Session::get('otp');
        $sessionEmail = Session::get('otp_email');

        if ($request->otp == $sessionOtp && $request->email == $sessionEmail) {
            // OTP verified, clear the session
            Session::forget('otp');
            Session::forget('otp_email');

            return response()->json([
                'success' => true,
                'message' => 'OTP verified successfully!',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid OTP or email!',
        ]);
    }


    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'region' => 'required|exists:regions,id',
            'district' => 'required|exists:districts,id',
            'tehsil' => 'required|exists:tehsils,id',
            'school_id' => 'required|string|max:255',
            'address' => 'required|string',
            'otp' => 'nullable|string|max:6', // Validate OTP only if provided
        ]);

        // Insert the data into the 'monitoring_requests' table
        MonitoringRequest::create([
            'full_name' => $validated['fullName'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'region_id' => $validated['region'],
            'district_id' => $validated['district'],
            'tehsil_id' => $validated['tehsil'],
            'school_id' => $validated['school_id'],
            'otp' => $validated['otp'], // Optional, only if OTP is provided
            'address' => $validated['address'],
            'status' => 'pending', // Default status is 'pending'
        ]);

        // Redirect or return response
        return redirect()->route('monitoring.success');  // Or any other route you prefer
    }
    
}
