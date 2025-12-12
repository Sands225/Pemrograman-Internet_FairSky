<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function login()
    {
        return view('login');
    }

    public function flights(){
        return view('flights');
    }

    public function register()
    {
        return view('register');
    }
}
