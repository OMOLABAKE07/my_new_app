<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; // Correct import for Auth facade
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    // Register User
    public function register(Request $request)
    {
        // validate
        $fields = $request->validate([
            'username' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'email', 'unique:users'],
            'password' => ['required', 'min:3', 'confirmed'],
        ]);

        // Register User
        $user = User::create($fields);

        Auth::login($user);

        // redirect to dashboard instead of home
        return redirect()->route('dashboard');
    }

    // login
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => ['required', 'max:255', 'email'],
            'password' => ['required'],
        ]);

        // try to login
        if (Auth::attempt($fields, $request->remember)) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->withErrors([
                'failed' => 'The provided credentials do not match our records.'
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
