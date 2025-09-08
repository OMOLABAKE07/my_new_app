<x-layout>
    {{-- <h1>Hello</h1> --}}
    <h1 class="title">Latest Posts</h1>
    {{-- <p>{{ $posts }}</p> --}}

    {{-- Title --}}
    <div class="grid grid-cols-2 gap-6">
    @foreach ($posts as $post)
        <x-PostCard :post="$post" />

    @endforeach
    </div>
    <div>{{ $posts->links() }}</div>
</x-layout>
