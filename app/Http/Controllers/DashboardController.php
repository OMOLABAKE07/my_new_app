<?php

namespace App\Http\Controllers;

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class DashboardController extends Controller 
// implements HasMiddleware
{

// public static function middleware(): array
// {
//     return [
//         'auth',
//         new Middleware('log', only: ['index']),
//         new Middleware('subcribed', except: ['store']),

//     ];
// }

    public function index()
    {
        return view('users.dashboard');
    }
}
