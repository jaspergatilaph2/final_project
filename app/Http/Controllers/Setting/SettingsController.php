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
}
