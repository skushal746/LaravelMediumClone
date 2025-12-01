<x-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex items-center">
                        <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-24 h-24 rounded-full mr-6">
                        <div>
                            <h1 class="text-3xl font-bold">{{ $user->name }}</h1>
                            <p class="text-gray-600">@{{ $user->username }}</p>
                            @if($user->bio)
                                <p class="text-gray-700 mt-2">{{ $user->bio }}</p>
                            @endif
                            <div class="flex items-center space-x-4 mt-4">
                                <span class="text-sm text-gray-500">{{ $user->posts->count() }} posts</span>
                                <span class="text-sm text-gray-500">{{ $user->followers->count() }} followers</span>
                                <span class="text-sm text-gray-500">{{ $user->following->count() }} following</span>
                            </div>
                            @auth
                                @if(auth()->id() !== $user->id)
                                    <form action="{{ $isFollowing ? route('users.unfollow', $user) : route('users.follow', $user) }}" method="POST" class="mt-4 inline">
                                        @csrf
                                        @if($isFollowing)
                                            @method('DELETE')
                                        @endif
                                        <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                            {{ $isFollowing ? 'Unfollow' : 'Follow' }}
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-6">Posts</h2>
                    @forelse($posts as $post)
                        <x-post-item :post="$post" />
                    @empty
                        <p class="text-gray-500">No posts yet.</p>
                    @endforelse

                    <div class="mt-6">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

