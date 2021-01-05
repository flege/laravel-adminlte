<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('role');
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
