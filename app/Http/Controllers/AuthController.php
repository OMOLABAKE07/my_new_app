<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth; // Correct import for Auth facade
// use Illuminate\Container\Attributes\Auth;
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
        // $user = User::create($fields);


        Auth::login($user);
        return redirect()->route('home');
    }
    // login
    public function login(Request $request)
    {
        // dd('ok');
        $fields = $request->validate([
            'email' => ['required', 'max:255', 'email'],
            'password' => ['required'],
        ]);

        // dd($request);
    // try to login
       if (Auth::attempt($fields, $request->remember)) {
       return redirect()->intended('dashboard');
       } 
       else {
            return redirect()->back()->withErrors(['failed' => 'The provided credentials does not match our record.'
        ]);
        }
    }
    public function logout(Request $request){
        // dd('ok');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
