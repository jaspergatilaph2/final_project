<?php

namespace App\Http\Controllers\appointment;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\Appointment;
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

    public function updateStatus($id, $status)
    {
        $appointment = Appointment::findOrFail($id);

        if ($status === 'pending' || $status === 'confirmed') {
            $appointment->status = $status;
            $appointment->save();

            if ($status === 'pending') {
                session()->flash('success', 'Appointment is now pending.');
            } else {
                session()->flash('success', 'Appointment confirmed successfully.');
            }
        } else {
            session()->flash('error', 'Invalid status update.');
            return redirect()->back();
        }

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

}
