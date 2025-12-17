<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
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
}
