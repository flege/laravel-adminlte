<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        if(Auth::id()) return redirect()->route('dashboard');
        return view('auth.login');
    }
}
