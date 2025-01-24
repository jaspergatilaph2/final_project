<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';

    // Define the fillable fields to allow mass assignment
    protected $fillable = [
        'user_id',
        'doctor_id',
        'appointment_date',
        'reason',
    ];

    /**
     * Get the user associated with the appointment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class); // An appointment belongs to one doctor
    }

    /**
     * Create a new appointment.
     *
     * @param  array  $data
     * @return \App\Models\Appointment
     */
    public static function createAppointment(array $data)
    {
        // Use the fillable attributes to create the appointment
        return self::create([
            'user_id' => $data['user_id'],
            'doctor_id' => $data['doctor_id'],
            'appointment_date' => $data['appointment_date'],
            'reason' => $data['reason'],
        ]);
    }


}
