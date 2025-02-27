<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventNotifications extends Notification
{
    use Queueable;

    public $event;

    public function __construct($event)
    {
        $this->event = $event;
    }

    public function via($notifiable)
    {
        return ['database']; // Store notifications in the database
    }

    public function toDatabase($notifiable)
    {
        return [
            'event_id' => $this->event->id,
            'message' => "A new event '{$this->event->eventsName}' has been created.",
        ];
    }
}
