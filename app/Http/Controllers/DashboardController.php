<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Guzzle\Http\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // $posts = Post::where('user_id', Auth::id())->get();
        // dd($posts);

        $posts = Auth::user()->posts()->latest()->paginate(6);
        return view('users.dashboard', ['posts' => $posts ]);
    }

    public function userPosts(User $user) {
        // dd($user->posts);
        $userPosts = $user->posts()->latest()->paginate(6);
        return view('users.posts', [
            'posts' => $userPosts,
            'user' => $user 
        ]);

    }
}
