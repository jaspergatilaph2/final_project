<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;  // Correct import for Rule class


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
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after:today',
            'reason' => 'required|string|max:255',
        ]);

        // Create a new appointment
        Appointment::create([
            'user_id' => auth()->id(),
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'reason' => $request->reason,
        ]);

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


}