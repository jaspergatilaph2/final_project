<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\logs;
use App\Models\user_logs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class UsersController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            return view('home');
        }

        return redirect()->route('user.dashboard')->with('error', 'Unauthorized access.');
    }

    public function create()
    {
        $doctors = Doctor::all();
        return view('user.appointments.create', [
            'userActive' => 'Appointments',
            'userActiveSub' => 'Create'
        ], compact('doctors'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after:today',
            'reason' => 'required|string|max:255',
        ]);

        // Check if the doctor is available (assuming 'is_available' field is a boolean in the doctors table)
        $doctor = Doctor::find($request->doctor_id);

        if (!$doctor || !$doctor->is_available) {
            return back()->withErrors(['doctor_id' => 'The selected doctor is not available.']);
        }

        // Check if the doctor is already booked for the requested date and time
        $existingAppointment = Appointment::where('doctor_id', $request->doctor_id)
            ->whereDate('appointment_date', $request->appointment_date)
            ->exists();

        if ($existingAppointment) {
            return back()->withErrors(['appointment_date' => 'The selected doctor is already booked for this date and time.']);
        }

        // Create a new appointment
        $appointment = Appointment::create([
            'user_id' => auth()->id(),
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'reason' => $request->reason,
        ]);

        logs::create([
            'user_id' => $appointment->user_id,
            'description' => "User " . ($appointment->user?->name ?? 'Unknown User') .
                " booked an appointment with Doctor " .
                ($appointment->doctor?->name ?? 'Unknown Doctor') . ". Status: Pending."
        ]);

        // Redirect with success message
        return redirect()->route('user.appointments.create')->with('success', 'Appointment booked successfully!');
    }

    public function showAppointments()
    {
        $appointments = Appointment::with(['user', 'doctor'])->get();
        return view('appointments.index', compact('appointments'));
    }

    public function showProfile()
    {
        $user = Auth::user();

        return view('user.account.showProfile', [
            'ACTIVEPROFILE' => 'ACCOUNT',
            'ACTIVEPROFILESUB' => 'SETTINGS'
        ], compact('user'));
    }

    public function showLogs()
    {
        $userId = auth()->id(); // Get authenticated user ID

        // Fetch only logs belonging to the logged-in user and paginate the results
        $logs = user_logs::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(10); // Ensure pagination works

        return view('user.misc.showlogs', [
            'logs' => $logs, // Pass logs correctly
            'userLogs' => 'Logs',
            'userLogsSub' => 'View'
        ]);
    }
}
