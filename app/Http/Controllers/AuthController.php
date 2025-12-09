<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // cari user berdasarkan email
        $user = DB::table('users')->where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email not found.');
        }

        // cek password hashing
        if (!Hash::check($request->password, $user->password_hash)) {
            return back()->with('error', 'Incorrect password.');
        }

        // simpan data user ke session
        Session::put('user_id', $user->id);
        Session::put('user_name', $user->full_name);
        Session::put('user_email', $user->email);

        return redirect('/'); // redirect ke homepage
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }
}
