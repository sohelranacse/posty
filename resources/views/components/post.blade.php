@props(['post' => $post])

<div class="mb-4">
    <a href="{{ route('users.posts', $post->user) }}" class="font-bold">{{ $post->user->name }}</a> <span
        class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>

    <p>{{ Str::limit($post->body, 200) }}
        @if (strlen($post->body) > 200)
            <a class="mb-3 text-blue-500" href="{{ route('posts.show', $post->id) }}">Read more</a>
        @endif
    </p>


    @can('delete', $post)
        <form action="{{ route('posts.destroy', $post) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-blue-500">Delete</button>
        </form>
    @endcan

    <div class="flex items-center">
        @auth
            @if (!$post->likedBy(auth()->user()))
                <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                    @csrf
                    <button type="submit" class="text-blue-500">Like</button>
                </form>
            @else
                <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-blue-500">Unlike</button>
                </form>
            @endif
        @endauth

        <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
    </div>
</div>
