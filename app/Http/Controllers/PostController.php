<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // the variable $posts is an array of all the posts in the database in descending order of creation date
        // $posts = Post::orderBy('created_at', 'desc')->get();
        // $posts = Post::all();
        $posts = Post::latest()->paginate(6);
        //    dd($posts);
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($fields)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd(Auth::user()->posts());

        // validation
        $fields =  $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],
        ]);


        // Create a post
        Auth::user()->posts()->create($fields);
        //  Post::create(['user_id' => Auth::id(), ...$fields ]);
        return back()->with('success', 'Your post was created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
