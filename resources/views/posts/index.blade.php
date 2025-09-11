<x-layout>
    {{-- <h1>Hello</h1> --}}
    <h1 class="title">Latest Posts</h1>

    {{-- <img src="{{ asset('storage/posts_images/public/storage/posts_images/quQM7IDaxxXO3f7fF6IdM6z1rHqwrfFw1UsboWRj.jpg') }}" alt=""> --}}
    {{-- <p>{{ $posts }}</p> --}}

    {{-- Title --}}
    <div class="grid grid-cols-2 gap-6">
    @foreach ($posts as $post)
        <x-PostCard :post="$post" />

    @endforeach
    </div>
    <div>{{ $posts->links() }}</div>
</x-layout>
