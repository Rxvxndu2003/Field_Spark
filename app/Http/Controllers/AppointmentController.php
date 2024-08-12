<?php

// app/Http/Controllers/AppointmentController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\Instructor; // Import Instructor model if needed

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'instructor_id' => 'required|exists:instructors,id',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        // Create an appointment
        Appointment::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'contact_number' => $request->contact_number,
            'instructor_id' => $request->instructor_id,
            'date' => $request->date,
            'time' => $request->time,
        ]);

        // Redirect with success message
        return redirect()->back()->with('success', 'Your appointment is successfully placed!');
    }
    
    public function getAppointments($instructorId)
{
    // Fetch appointments for the given instructor
    $appointments = Appointment::where('instructor_id', $instructorId)->get();

    return response()->json($appointments);
}

public function destroy($id)
{
    $appointment = Appointment::find($id);

    if ($appointment) {
        $appointment->delete();
        return response()->json(['message' => 'Appointment deleted successfully.'], 200);
    }

    return response()->json(['message' => 'Appointment not found.'], 404);
}
public function transfer(Request $request, $id)
{
    $appointment = Appointment::find($id);
    $newInstructorId = $request->input('instructor_id');

    if ($appointment && $newInstructorId) {
        $appointment->instructor_id = $newInstructorId;
        $appointment->save();

        return response()->json(['message' => 'Appointment transferred successfully.'], 200);
    }

    return response()->json(['message' => 'Error transferring appointment.'], 400);
}


}
