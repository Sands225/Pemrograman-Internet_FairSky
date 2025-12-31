<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $rules = [];

        // (update nama)
        if (!$request->has('tab') || $request->tab == 'profile') {
            $rules['full_name'] = 'required|string|max:100';
        }

        // (update password)
        if ($request->tab == 'security' || $request->filled('current_password')) {
            $rules['current_password'] = 'required';
            $rules['new_password'] = 'required|min:8|confirmed';

            // Validasi
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->route('profile.index', ['tab' => 'security'])
                    ->withErrors(['current_password' => 'Password does not match our records.'])
                    ->withInput();
            }
        }

        $request->validate($rules);

        if ($request->filled('full_name')) {
            $user->full_name = $request->full_name;
        }

        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        if ($user->isDirty()) {
            $user->save();
            return redirect()->route('profile.index', ['tab' => $request->tab])
                ->with('success', 'Changes saved successfully.!');
        }
    }
}
