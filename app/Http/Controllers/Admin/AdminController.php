<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\logs;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('admin.dashboard.home', compact('user'));
    }

    public function showProfile()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
        }

        return view('admin.account.showProfile', [
            'ACTIVEPROFILE' => 'ACCOUNT',
            'ACTIVEPROFILESUB' => 'SETTINGS'
        ], compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Find the user by ID, not by auth()
        $user = User::findOrFail($id);

        // Update the user's profile
        $user->name = $request->name;
        $user->email = $request->email;

        // If there's a new avatar image, upload it
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('avatars', 'public');
            $user->avatar = $path;
        }

        // Save the updated user
        if ($user) {
            $user->save();
        } else {
            return redirect()->route('login')->with('error', 'You must be logged in to update the profile.');
        }
        logs::create([
            'user_id' => $user->id,
            'description' => "Admin {$user->name} updated their profile."
        ]);
        // Redirect back to the edit page with a success message
        return redirect()->route('admin.accounts.profile.edit')
            ->with('success', 'Profile updated successfully.');
    }

    public function editProfile()
    {
        $user = auth()->user();
        return view('admin.profile.edit', [
            'ACTIVEPROFILE' => 'ACCOUNT',
            'ACTIVEPROFILESUB' => 'SETTINGS'
        ], compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'avatar' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Get authenticated user
        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;

        // If there's a new avatar, upload it
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Store new file
            $path = $request->file('avatar')->store('avatar', 'public');
            $user->avatar = $path;
        }

        // Save updated user
        $user->save();

        // Log the update
        logs::create([
            'user_id' => $user->id,
            'description' => "User {$user->name} updated their profile."
        ]);

        // Handle AJAX request
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'avatar_url' => $user->avatar ? asset('storage/' . $user->avatar) : null
            ]);
        }

        // Redirect back for normal request
        return redirect()->route('admin.accounts.profile.edit')
            ->with('success', 'Profile updated successfully.');
    }



    public function showLogs()
    {
        $logs = logs::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.misc.showlogs', [
            'ACTIVEPROFILE' => 'MISC',
            'ACTIVEPROFILESUB' => 'LOGS',
            'logs' => $logs // Pass logs correctly
        ]);
    }
}
