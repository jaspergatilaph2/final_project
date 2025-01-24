<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;

class AppointmentApproved extends Notification
{
    // use Queueable, Notifiable;

    // protected $appointment;

    // public function __construct($appointment)
    // {
    //     $this->appointment = $appointment;
    // }

    // public function via($notifiable)
    // {
    //     return ['database', 'mail']; // Add channels like 'database', 'mail', etc.
    // }

    // public function toDatabase($notifiable)
    // {
    //     return [
    //         'message' => "Your appointment with Dr. {$this->appointment->doctor->name} has been approved.",
    //         'appointment_id' => $this->appointment->id
    //     ];
    // }

    // public function toMail($notifiable)
    // {
    //     return (new \Illuminate\Notifications\Messages\MailMessage)
    //         ->subject('Appointment Approved')
    //         ->line("Your appointment with Dr. {$this->appointment->doctor->name} has been approved.")
    //         ->action('View Appointment', url('/appointments/' . $this->appointment->id));
    // }
}
