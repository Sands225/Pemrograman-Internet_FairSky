<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $airports = \App\Models\Airport::orderBy('city', 'asc')->get();
        return view('home', compact('airports'));
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function flights(){
        return view('flights.index');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    public function about()
    {
        return view('about');
    }

    public function help()
    {
        return view('help');
    }

    // public function adminFlightListPage()
    // {
    //     return view('admin.flights.index');
    // }
}
