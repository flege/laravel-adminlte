<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
//        $this->middleware('role'); // all role can access
//        $this->middleware('role:admin'); // only admin can access
        $this->middleware('role:admin,user'); // admin or user can access
    }

    public function index()
    {
        $user = User::count();

        return view('dashboard', compact('user'));
    }
}
