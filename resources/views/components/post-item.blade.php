@props(['post'])

<article class="mb-8 pb-8 border-b border-gray-200">
    <div class="flex items-start">
        @if($post->image)
            <div class="flex-shrink-0 mr-4">
                <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-32 h-32 object-cover rounded">
            </div>
        @endif
        <div class="flex-1">
            <div class="flex items-center mb-2">
                <a href="{{ route('users.show', $post->user->username) }}" class="text-sm text-gray-600 hover:text-gray-900">
                    {{ $post->user->name }}
                </a>
                <span class="mx-2 text-gray-400">·</span>
                <span class="text-sm text-gray-500">{{ $post->published_at->format('M d, Y') }}</span>
            </div>
            <h2 class="text-2xl font-bold mb-2">
                <a href="{{ route('posts.show', $post->slug) }}" class="text-gray-900 hover:text-gray-700">
                    {{ $post->title }}
                </a>
            </h2>
            <p class="text-gray-600 mb-3">{{ $post->excerpt }}</p>
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('categories.show', $post->category->slug) }}" class="text-sm text-gray-500 hover:text-gray-700">
                        {{ $post->category->name }}
                    </a>
                    <span class="text-sm text-gray-400">{{ $post->likes->count() }} likes</span>
                </div>
                @auth
                    <form action="{{ $post->isLikedBy(auth()->user()) ? route('posts.unlike', $post) : route('posts.like', $post) }}" method="POST" class="inline">
                        @csrf
                        @if($post->isLikedBy(auth()->user()))
                            @method('DELETE')
                        @endif
                        <button type="submit" class="text-sm {{ $post->isLikedBy(auth()->user()) ? 'text-red-500' : 'text-gray-500' }} hover:text-red-500">
                            ❤️
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</article>

