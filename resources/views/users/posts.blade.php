<x-layout>
     {{-- {{ $posts->count() }} --}}
    {{-- {{ $posts->total() }} --}}
    <h1 class="title">{{ $user->username }}'s Posts &#9830; {{ $posts->total() }}</h1>

        <div class="grid grid-cols-2 gap-6">
    @foreach ($posts as $post)
        <x-PostCard :post="$post" />

    @endforeach
    </div>
</x-layout>