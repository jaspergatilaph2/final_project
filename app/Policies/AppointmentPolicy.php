<?php

namespace App\Policies;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AppointmentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    /**
     * Determine if the given user can update the appointment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Appointment  $appointment
     * @return bool
     */
    public function update(User $user, Appointment $appointment)
    {
        // Example: Only allow the user to update their own appointments
        return $user->id === $appointment->user_id;
    }
}
