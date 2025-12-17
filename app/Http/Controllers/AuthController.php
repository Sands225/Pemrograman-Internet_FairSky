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

        return redirect('/');
    }

    public function register(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6|confirmed'
        ]);

        // simpan user ke database
        $userId = DB::table('users')->insertGetId([
            'full_name'     => $request->full_name,
            'email'         => $request->email,
            'password_hash' => Hash::make($request->password),
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        // login otomatis setelah register
        Session::put('user_id', $userId);
        Session::put('user_name', $request->full_name);
        Session::put('user_email', $request->email);

        return redirect('/');
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }
}
