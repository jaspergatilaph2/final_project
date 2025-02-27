<?php

namespace App\Http\Controllers\appointment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentControllers extends Controller
{
    public function getAppointmentData()
    {
        // Query to count appointments per month
        $appointments = DB::table('appointments')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Prepare the data for Chart.js
        $labels = [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December"
        ];

        // Initialize monthly data with 0 appointments
        $data = array_fill(0, 12, 0);

        foreach ($appointments as $appointment) {
            $data[$appointment->month - 1] = $appointment->count;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }
}
