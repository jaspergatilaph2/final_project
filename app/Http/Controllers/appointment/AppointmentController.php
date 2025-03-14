<?php

namespace App\Http\Controllers\appointment;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\logs;
use Illuminate\Support\Facades\Auth;


class AppointmentController extends Controller
{
    public function index()
    {
        return view('admin.appointments.appointments', [
            'activePage' => 'appointments'
        ]);
    }

    public function create()
    {
        return view('admin.appointments.create', [
            'activePage' => 'appointments',
            'isActivePageSub' => 'AddAppointments'
        ]);
    }

    public function updateStatus(Request $request, $id, $status)
    {
        $appointment = Appointment::findOrFail($id);

        if (in_array($status, ['pending', 'confirmed', 'cancelled'])) {
            $appointment->status = $status;
            $appointment->save();

            // logs Status Changes
            if ($status === 'pending') {
                logs::create([
                    'user_id' => $appointment->user_id,
                    'description' => "User #{$appointment->user_id} booked an appointment (ID: {$appointment->id}) with Doctor #{$appointment->doctor_id}. Status: Pending."
                ]);
                session()->flash('success', 'Appointment is now pending.');
            } elseif ($status === 'confirmed') {
                logs::create([
                    'user_id' => $appointment->user_id,
                    'description' => "User " . ($appointment->user?->name ?? 'Unknown User') .
                        " booked an appointment. " .
                        "Appointment with Doctor " .
                        ($appointment->doctor?->name ?? 'Unknown Doctor') .
                        " was confirmed by Admin."
                ]);
                session()->flash('success', 'Appointment confirmed successfully.');
            } elseif ($status === 'cancelled') {
                logs::create([
                    'user_id' => $appointment->user_id,
                    'description' => "User " . ($appointment->user?->name ?? "Unknown User") . " Booked an appointment. " . "Appointment with Doctor " .
                        ($appointment->doctor?->name ?? "Unknown Doctor") . " was cancelled by Admin"
                ]);
                session()->flash('success', 'Appointment cancelled successfully.');
            }

            return redirect()->back();
        }

        // If status is invalid, logs it and show an error message
        logs::create([
            'user_id' => auth()->id(),
            'description' => "Attempted invalid status update on Appointment #{$appointment->id}."
        ]);
        session()->flash('error', 'Invalid status update.');
        return redirect()->back();
    }


    public function viewAppointments()
    {
        $appointments = Appointment::with('user', 'doctor')->get();
        return view('admin.appointments.view', [
            'ISACTIVEMUNE' => 'APPOINTMENTS',
            'ACTIVEMENUSUB' => 'VIEW'
        ], compact('appointments'));
    }

    public function showDashboard()
    {
        $notifications = Auth::user()->notifications;

        $appointments = Appointment::with('user', 'doctor')->get();

        return view('user.notification.view', [
            'appointments' => $appointments,
            'notifications' => $notifications
        ], [
            'MENUACTIVE' => 'APP',
            'MENUACTIVESUB' => 'VIEWS'
        ]);
    }

    public function calendar()
    {
        return view('user.appointments.calendar', [
            'ACTIVEPROFILE' => 'ACCOUNT',
            'ACTIVEPROFILESUB' => 'CALENDAR'
        ]);
    }

    public function getAppointment()
    {
        // Fetch appointments with associated doctor
        $appointments = Appointment::with('doctor')->get();

        // Prepare the event data for FullCalendar
        $events = $appointments->map(function ($appointment) {
            return [
                'id' => $appointment->id,
                'title' => $appointment->doctor->name, // Doctor's Name
                'start' => $appointment->appointment_date, // Appointment Date
            ];
        });

        // Return JSON response with structured data
        return response()->json([
            'appointments' => $events,
            'count' => Appointment::count(), // Get total appointment count directly
        ]);
    }


    public function destroy(Appointment $appointment)
    {
        try {
            $appointment->delete();
            logs::create([
                'user_id' => $appointment->user_id,
                'description' => "User " . ($appointment->user?->name ?? 'Unknown User') .
                    " had their appointment with Doctor " .
                    ($appointment->doctor?->name ?? 'Unknown Doctor') .
                    " deleted by Admin."
            ]);
            return redirect()->route('admin.appointments.view')->with('success', 'Appointment deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.appointments.view')->with('error', 'Failed to delete appointment.');
        }
    }
}
