<?php

namespace App\Http\Controllers\events;

use App\Http\Controllers\Controller;
use App\Models\events;
use App\Models\logs;
use App\Models\User;
use App\Notifications\EventNotifications;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function createEvent()
    {
        return view('admin.events.create', [
            'ActiveCreateMenu' => 'Create',
            'ActiveCreateSubMenu' => 'Event'
        ]);
    }

    public function store(Request $request)
    {
        // Validate the request
        $this->validate($request, [
            'eventsName' => 'required|string|max:255',
            'description' => 'required|string',
            'eventsText' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'endtime' => 'required|date_format:H:i',
        ]);

        // Create event
        $event = new Events();
        $event->eventsName = $request->input('eventsName');
        $event->description = $request->input('description');
        $event->eventsText = $request->input('eventsText');
        $event->date = $request->input('date');
        $event->time = $request->input('time');
        $event->endtime = $request->input('endtime');

        $event->save();

        // Notify users about the new event
        $users = User::all(); // Fetch all users
        foreach ($users as $user) {
            DB::table('notifications')->insert([
                'id' => Str::uuid(), // Generate unique ID
                'type' => 'App\\Notifications\\EventCreatedNotification',
                'data' => json_encode([
                    'message' => 'A new event "' . $event->eventsName . '" has been created.',
                    'received_message' => 'You have received a new event notification for "' . $event->eventsName . '".'
                ]),
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => $user->id, // User ID
                'event_id' => $event->id, // Associated Event ID
                'description' => 'Event Notification',
                'eventText' => 'A new event has been added',
                'is_read' => 0, // 0 means unread
                'read_at' => null, // Initially null
                'created_at' => Carbon::now(), // Current timestamp
                'updated_at' => Carbon::now(),
            ]);
        }

        // Log the event creation
        logs::create(['description' => 'Event "' . $event->eventsName . '" created successfully!']);

        return redirect()->back()->with('success', 'Event created and users notified!');
    }


    public function viewEvents(Request $request)
    {
        $notificationId = $request->input('notificationId');

        if ($notificationId) {
            $notification = auth()->user()->notifications->where('id', $notificationId)->first();
            if ($notification) {
                $notification->markAsRead(); // Mark as read
            }
        }

        $events = Events::orderBy('date', 'desc')->paginate(10);

        return view('admin.events.view', [
            'ActiveViewMenu' => 'View',
            'ActiveViewSubMenu' => 'Events',
            'events' => $events
        ]);
    }


    public function view()
    {
        $events = events::orderBy('date', 'desc')->paginate(10);
        return view('user.events.view', [
            'ActiveMenu' => 'Events',
            'ActiveSubMenu' => 'View',
            'events' => $events
        ]);
    }

    public function destroy($id)
    {
        $events = events::findOrFail($id);
        $events->delete();

        logs::create(['description' => 'Event "' . $events->eventsName . '" successfully deleted!']);
        return back()->with('success', 'Event deleted successfully.');
    }

}
