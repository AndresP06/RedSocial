<div>
    @if ($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post)
            
                <div>
                    
                    <a href="{{ route('posts.show', ['post' => $post->id, 'user' => $post->user->username]) }}">
                        <img src="{{ asset('storage/imagenes/post') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}"> {{-- Cambiado $posts->imagen a $post->imagen --}}
                    </a>
                </div>
            @endforeach
        </div>
        <div class=" my-5 ">
            {{ $posts->links('pagination::tailwind') }}
        </div>
    @else
    <p>no hay post</p>
    @endif
</div>