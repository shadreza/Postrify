@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12">
        <div class="p-6">
            <h1 class="text-center text-2xl font-medium mb-1">
                {{ $user->name }}
            </h1>
            <p>Posted {{ $posts->count() }} {{ Str::plural('post', $posts->count()) }} and recieved {{ $user->receivedLikes->count() }} {{ Str::plural('like', $user->receivedLikes->count()) }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg">
            @if ($posts->count())
                @foreach ($posts as $post)
                    <div class="mb-4">
                        <a href="{{ route('users.posts', $post->user) }}" class="font-bold mr-1">{{ $post->user->name }}</a>

                        @if ($post->created_at)
                            <span class="text-gray-500 text-sm">{{ $post->created_at->diffForHumans() }}</span>
                        @else
                            <span class="text-gray-500 text-sm">somewhere in time-space</span>
                        @endif

                        <p class="mb-2">{{ $post->body }}</p>

                        @auth
                            @can('delete', $post)
                                <div>
                                    <form action="{{ route('posts.destroy', $post) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500">Delete</button>
                                    </form>
                                </div>
                            @endcan
                        @endauth

                        {{-- adding the like and dislike here --}}
                        <div class="flex items-center">

                            {{-- as the user who is not signed in can not like / unlike so guarding with auth --}}
                            @auth

                                {{-- if the user has not yet liked the post only then like button will come --}}
                                @if (!$post->likedBy(auth()->user()))
                                    <form action="{{ route('posts.likes', $post->id) }}" method="post" class="mr-1">
                                        @csrf
                                        <button type="submit" class="text-blue-500">Like</button>
                                    </form>

                                {{-- if the user has liked the post then unlike will come --}}
                                @else
                                    <form action="{{ route('posts.likes', $post->id) }}" method="post" class="mr-1">
                                        @csrf
                                        {{-- this is method spoofing --}}
                                        {{-- keeps the thing restful --}}
                                        @method('DELETE')
                                        <button type="submit" class="text-purple-500">Unlike</button>
                                    </form>
                                @endif

                            @endauth

                            {{-- adding pluraliser to likes --}}
                            <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
                        </div>

                    </div>
                @endforeach


                {{ $posts->links() }}

            @else
                <p>{{ $user->name }} does not have any posts</p>
            @endif
        </div>

        </div>
    </div>
@endsection
