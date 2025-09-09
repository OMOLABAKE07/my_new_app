<x-layout>
    <a href="{{ route('dashboard') }}" class="block mb-2 text-xs text-blue-500">&lAarr; Go back to your dashboard</a>
    <div class="card">
        <h2 class="font-bold mb-4">Update your post</h2>
        <form action="{{ route('posts.update', $post) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title">Post Title</label>
                <input type="text" name="title" value="{{ $post->title }}"
                    class="input @error('title') ring-red-500
            @enderror">

                @error('title')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="body">Post Content</label>

                {{-- <textarea for="title">Post Title</textarea> --}}

                <textarea name="body" rows="4" class="textarea input @error('body') ring-red-500
            @enderror">{{ $post->body }}</textarea>
                {{-- <input type="text" name="title" value="" class=""> --}}

                @error('body')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <button class="btn">Update</button>
        </form>
    </div>
    </x-layout>
   