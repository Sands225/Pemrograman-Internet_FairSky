<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // validasi input
        $request->validate([
            'full_name' => 'required|string|max:100',
        ]);

        /** @var \App\Models\User $user **/
        $user->update([
            'full_name' => $request->full_name,
        ]);

        return redirect()->route('profile.index')->with('success', 'Profile Successfully Updated!');
    }
}
