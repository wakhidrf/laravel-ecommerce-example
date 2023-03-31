<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\hash;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Menampilkan Profil
    public function show_profile()
    {
        $user = Auth::user();
        return view('show_profile', compact('user'));
    }

    //Mengedit Profile
    public function edit_profile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            "password" => Hash::make($request->password)
        ]);

        return Redirect::back();
    }
}
