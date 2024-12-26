<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
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
}
