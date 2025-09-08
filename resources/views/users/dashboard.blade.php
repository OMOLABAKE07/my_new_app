<x-layout>
<h1 class="title">Hello {{ auth()->user()->username }}</h1>
<div class="card mb-4">
    <h2 class="font-bold mb-4">Create a new posts </h2>

    @if (session('success'))
        <div>
    <x-flashMsg  msg="{{ session('success') }}" />
     {{-- bg="bg-yellow-500" --}}
        {{-- <p class="text-green-500">{{ session('success') }}</p> --}}
    </div>
    @endif
    
    <form action="{{ route('posts.store') }}" method="post">
        @csrf
        <div class="mb-4">
            <label for="title">Post Title</label>
            <input type="text" name="title" value="{{ old('title') }}" class="input @error('title') ring-red-500
            @enderror">

            @error('title')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
           <div class="mb-4">
            <label for="body">Post Content</label>

            {{-- <textarea for="title">Post Title</textarea> --}}

            <textarea name="body" rows="4" class="textarea input @error('body') ring-red-500
            @enderror">{{ old('body') }}</textarea>
            {{-- <input type="text" name="title" value="" class=""> --}}

            @error('body')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <button class="btn">Create</button>
    </form>
</div>
</x-layout>