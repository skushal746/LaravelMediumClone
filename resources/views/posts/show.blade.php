<x-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <article class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($post->image)
                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-96 object-cover rounded mb-6">
                    @endif

                    <div class="flex items-center mb-4">
                        <a href="{{ route('users.show', $post->user->username) }}" class="text-sm text-gray-600 hover:text-gray-900">
                            {{ $post->user->name }}
                        </a>
                        <span class="mx-2 text-gray-400">·</span>
                        <span class="text-sm text-gray-500">{{ $post->published_at->format('M d, Y') }}</span>
                        <span class="mx-2 text-gray-400">·</span>
                        <a href="{{ route('categories.show', $post->category->slug) }}" class="text-sm text-gray-500 hover:text-gray-700">
                            {{ $post->category->name }}
                        </a>
                    </div>

                    <h1 class="text-4xl font-bold mb-4">{{ $post->title }}</h1>

                    <div class="prose max-w-none mb-6">
                        {!! nl2br(e($post->body)) !!}
                    </div>

                    <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-200">
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-500">{{ $post->likes->count() }} likes</span>
                        </div>
                        @auth
                            <div class="flex items-center space-x-4">
                                <form action="{{ $post->isLikedBy(auth()->user()) ? route('posts.unlike', $post) : route('posts.like', $post) }}" method="POST" class="inline">
                                    @csrf
                                    @if($post->isLikedBy(auth()->user()))
                                        @method('DELETE')
                                    @endif
                                    <button type="submit" class="text-lg {{ $post->isLikedBy(auth()->user()) ? 'text-red-500' : 'text-gray-500' }} hover:text-red-500">
                                        ❤️
                                    </button>
                                </form>
                                @can('update', $post)
                                    <a href="{{ route('posts.edit', $post) }}" class="text-sm text-indigo-600 hover:text-indigo-800">Edit</a>
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-red-600 hover:text-red-800">Delete</button>
                                    </form>
                                @endcan
                            </div>
                        @endauth
                    </div>
                </div>
            </article>
        </div>
    </div>
</x-layout>

