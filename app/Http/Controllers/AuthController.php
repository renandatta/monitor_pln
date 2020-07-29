<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function login_process(Request $request)
    {
        $request->validate([
            'email' => 'required|min:4|max:255',
            'password' => 'required|min:4|max:255'
        ]);
        $user = User::where('email', '=', $request->input('email'))->first();
        if (empty($user)) return redirect()->back()->withErrors(['Email salah !']);
        if (Hash::check($request->input('password'), $user->password)) {
            Auth::login($user, true);
            return redirect()->route('home');
        }
        return redirect()->back()->withErrors(['Password Salah !']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
