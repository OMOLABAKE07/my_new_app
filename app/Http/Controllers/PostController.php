<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\returnSelf;

class PostController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            // new Middleware('auth', only: ['str']),
            new Middleware('auth', except: ['index', 'show']),
        ];
    }

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
        //   dd('ok');
        // validation
        $fields =  $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],
            'image' => ['nullable', 'file', 'max:3000', 'mimes:png, jpg, webp, jpeg']
        ]);

        // Store image if exists
        $path = null;
        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('posts_images', $request->image);
            //   dd($path);
        }


        // Create a post
        Auth::user()->posts()->create(
            [
                'title' => $request->title,
                'body' => $request->body,
                'image' => $path,
            ]

        );
        //  Post::create(['user_id' => Auth::id(), ...$fields ]);
        return back()->with('success', 'Your post was created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Authorize Action
        Gate::authorize('modify', $post);
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        Gate::authorize('modify', $post);
        // dd($request->all());
        // validation
        $fields =  $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],
            'image' => ['nullable', 'file', 'max:3000', 'mimes:png,jpg,webp,jpeg'],

        ]);

        $path = $post->image ?? null;
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $path = Storage::disk('public')->put('posts_images', $request->image);
            // dd($path);
        }
        // Update a post

        $post->update(
            [
                'title' => $request->title,
                'body' => $request->body,
                'image' => $path,
            ]
        );
        // dd($post);
        // return back()->route('dashboard')->with('success', 'Your post was updated');
        return redirect()->route('dashboard')->with('success', 'Your post was updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Authorize Action
        Gate::authorize('modify', $post);

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        // dd('ok');
        $post->delete();
        return back()->with('delete', 'Your Post was deleted!');
    }
}
