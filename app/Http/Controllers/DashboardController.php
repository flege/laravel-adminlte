<?php

namespace App\Http\Controllers;
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
        if (Auth::user()->role == 'admin') {
            $barang = array();
        }else{
            $barang = array();
        }

        return view('base', compact('barang'));
    }
}
