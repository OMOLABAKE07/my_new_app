     @props(['post', 'full' => false])  
       
       <div class="card">
            <h2 class="font-bold text-xl"> {{ $post->title }}</h2>

            {{-- Author and date  --}}

            <div class="text-xs font-light mb-4">

                {{-- created-at will show the date & time while the DiffForHumans will show the time hrs/mins/sec --}}
                <span>Posted {{ $post->created_at->diffForHumans() }} by</span>
                <a href="{{ route('posts.user', $post->user) }}" class="text-blue-500 font-medium">{{ $post->user->username }}</a>
            </div>



            @if ($full)
                   <div class="text-sm">
                <span>{{ $post->body }}</span>
            </div>
            @else
                   <div class="text-sm">
                {{-- text-body --}}
                {{-- <p>{{ $post->body }}</p> --}}
                {{-- this will give us the first 15 words of the post --}}
                <span>{{ Str::words($post->body, 15) }}</span>
                <a href="{{ route('posts.show', $post) }}" class="text-blue-500 ml-2">Read more &rarr;</a>
            </div>
            @endif
        <div class="flex item-center justify-end gap-4">{{ $slot }}</div>
         
        </div>