<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('home', compact('user'));
    }
}
