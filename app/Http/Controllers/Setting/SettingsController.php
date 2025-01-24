<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function settings()
    {
        return view('settings.darkmode', [
            'activeMenu' => 'Dashboard',
            'activeSub' => 'Settings',
        ]);
    }

    public function userSettings()
    {
        // Ensure the view is specific to user settings
        return view('user.settings.darkmode',[
            'activeMenu' => 'Dashboard',
            'activeSub' => 'Settings',
        ]);
    }
}
