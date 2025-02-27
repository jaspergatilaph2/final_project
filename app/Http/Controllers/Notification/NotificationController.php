<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Models\events;
use App\Models\User;
use App\Notifications\EventNotifications;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    // Fetch unread notifications
    public function markRead($id)
    {
        $notification = auth()->user()->notifications->where('id', $id)->first();

        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->back();
    }

    public function markAllRead()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return redirect()->back();
    }
}
