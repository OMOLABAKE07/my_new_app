<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; // Correct import for Auth facade
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

        event (new Registered($user));

        // redirect to dashboard instead of home
        return redirect()->route('dashboard');
    }

    public function verifyNotice(){
        return view('auth.verify-email');
    }

    public function verifyEmail(EmailVerificationRequest $request){
        $request->fulfill();
        return redirect()->route('dashboard');
    }


// Resending the verification Email route
public function verifyHandler(Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
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
