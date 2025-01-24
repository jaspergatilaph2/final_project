<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $user = auth()->user(); 
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatar', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return redirect()->route('user.account.profile.edit')->with('success', 'Profile updated successfully.');
    }

    public function edit()
    {
        $user = auth()->user(); 
        return view('user.profile.edit', [
            'ACTIVEPROFILE' => 'ACCOUNT',
            'ACTIVEPROFILESUB' => 'SETTINGS'
        ], compact('user')); 
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();

        $avatarPath = $request->file('avatar')->store('avatar', 'public');

        $user->avatar = $avatarPath;
        $user->save();

        return response()->json([
            'success' => true,
            'avatar_url' => asset('storage/' . $avatarPath)
        ]);
    }
}
