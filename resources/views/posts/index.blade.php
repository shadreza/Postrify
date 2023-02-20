@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-10/12 bg-white p-6 rounded-lg">
            <form action="{{ route('posts') }}" method="post" class="mb-4">
                @csrf
                <div class="mb-4">
                    <label for="body" class="sr-only">Body</label>
                    <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" placeholder="Post something!"></textarea>

                    @error('body')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">
                        Post
                    </button>
                </div>
            </form>

            {{-- iterating through the posts --}}
            {{-- Carbon is a third party date time manipulation library --}}
            @if ($posts->count())
                @foreach ($posts as $post)
                    <div class="mb-4">
                        <a href="" class="font-bold mr-1">{{ $post->user->name }}</a>

                        @if ($post->created_at)
                            <span class="text-gray-500 text-sm">{{ $post->created_at->diffForHumans() }}</span>
                        @else
                            <span class="text-gray-500 text-sm">somewhere in time-space</span>
                        @endif

                        <p class="mb-2">{{ $post->body }}</p>

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
                                        <button type="submit" class="text-red-500">Unlike</button>
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
                <p>There are no posts</p>
            @endif

        </div>
    </div>
@endsection
