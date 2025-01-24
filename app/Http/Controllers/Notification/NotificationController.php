<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications;

        return view('user.notifications.index', compact('notifications'));
    }

    public function markAsRead($notificationId)
    {
        $notification = Auth::user()->notifications()->findOrFail($notificationId);
        $notification->markAsRead();

        $notificationId = $notification->id;
        return redirect()->route('user.account.notifications.read', ['notification' => $notification->id]);
    }

    public function readAll()
    {
        $user = auth()->user();

        $notifications = $user->unreadNotifications; 

        foreach ($notifications as $notification) {
            $notification->markAsRead();
        }

        return redirect()->back()->with('success', 'All notifications marked as read.');
    }

    public function notifications()
    {
        return auth()->user()->morphMany(\Illuminate\Notifications\Notification::class, 'notifiable');
    }
}
