<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\Appointment;

class InstructorAuthController extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:instructors',
            'location' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'job' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()], 400);
        }

        $instructor = Instructor::create([
            'name' => $request->name,
            'email' => $request->email,
            'location' => $request->location,
            'phone' => $request->phone,
            'job' => $request->job,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('instructor.login')->with('status', 'Registration successful! You can now log in.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('instructor')->attempt($credentials)) {
            // $request->session()->regenerate();
            return redirect()->intended('/idashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('instructor')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'You have been logged out.');
    }

    public function getInstructors()
    {
        // Retrieve all instructors
        $instructors = Instructor::all();

        // Return JSON response
        return response()->json($instructors);
    }


    public function getAppointments($instructor_id)
    {
        // Fetch appointments for the instructor
        $appointments = Appointment::where('instructor_id', $instructor_id)->get();
    
        // Return JSON response
        return response()->json($appointments);
    }
    public function manageAppointments()
    {
        // Get the instructor ID from the authenticated user
        $instructorId = Auth::id();

        // Fetch appointments for the instructor
        $appointments = Appointment::where('instructor_id', $instructorId)->get();

        // Return view with appointments
        return view('pages.adminappoint', compact('appointments'));
    }

    public function index()
    {
        $instructors = Instructor::all();
        return view('instructors.index', compact('instructors'));
    }
    
}
