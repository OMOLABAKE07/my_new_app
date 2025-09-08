<x-layout>
    {{-- <h1>Hello</h1> --}}
    <h1 class="title">Latest Posts</h1>
    {{-- <p>{{ $posts }}</p> --}}

    {{-- Title --}}
    <div class="grid grid-cols-2 gap-6">
    @foreach ($posts as $post)
        <div class="card">
            <h2 class="font-bold text-xl"> {{ $post->title }}</h2>

            {{-- Author and date  --}}

            <div class="text-xs font-light mb-4">

                {{-- created-at will show the date & time while the DiffForHumans will show the time hrs/mins/sec --}}
                <span>Posted {{ $post->created_at->diffForHumans() }} by</span>
                <a href="" class="text-blue-500 font-medium">USERNAME</a>
            </div>
            <div class="text-sm">
                {{-- text-body --}}
                {{-- <p>{{ $post->body }}</p> --}}
                {{-- this will give us the first 15 words of the post --}}
                <p>{{ Str::words($post->body, 15) }}</p>
            </div>
        </div>
    @endforeach
    </div>
    <div>{{ $posts->links() }}</div>
</x-layout>
