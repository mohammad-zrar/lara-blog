@extends('layouts.app')
@section('content')
    <h1 class="text-3xl text-orange-950 font-bold">
        {{ $blog->title }}
        <span class="text-2xl text-orange-900 font-semibold">({{ $blog->reading_time }} min)</span>
    </h1>

    <p class="text-orange-900">
        Category:
        <a class="underline hover:text-orange-800" href="/?category={{ $blog->category->name }}">
            {{ $blog->category->name }}
        </a>
    </p>

    <p class="text-orange-900">
        Created at {{ $blog->created_at->format('F j, Y ') }} by
        <a class="underline hover:text-orange-800" href="/{{ $blog->user->username }}">
            {{ $blog->user->full_name }}
        </a>
    </p>

    <p class="text-orange-800">Updated At {{ $blog->updated_at->format('F j, Y ') }}</p>

    @if (!empty($blog->tags))
        <div class="flex justify-end flex-wrap gap-2 my-2">
            @foreach ($blog->tags as $tag)
                <span
                    class="border border-orange-200 px-3 py-1 rounded-full text-sm text-gray-800 bg-orange-50 hover:bg-orange-100 transition">
                    {{ $tag->name }}
                </span>
            @endforeach
        </div>
    @endif

    <div class=" p-4 border border-gray-300  shadow-md rounded-md">
        {!! Str::markdown($blog->content) !!}
    </div>

    <div class="mt-8">
        <h2 class="text-2xl font-bold text-orange-950">Comments</h2>

        @auth
            <form action="{{ route('comments.store') }}" method="POST" class="mt-4">
                @csrf
                <input type="hidden" name="post_id" value="{{ $blog->id }}">
                <textarea name="content" rows="3" class="w-full border border-gray-300 rounded-md p-2"
                    placeholder="Add a comment..."></textarea>
                <x-button type="submit" class="mt-2">Submit</x-button>
            </form>
        @endauth

        <div class="mt-6">
            @foreach ($comments as $comment)
                <div class="border border-gray-300 rounded-md p-4 mb-4">
                    <p class="text-gray-800">{{ $comment->content }}</p>
                    <p class="text-sm text-gray-500">By {{ $comment->user->full_name }} on
                        {{ $comment->created_at->format('F j, Y') }}</p>

                    @if (auth()->check() && auth()->id() === $comment->user_id)
                        <div class="flex justify-end gap-2 mt-2">
                            <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <textarea name="content" rows="2" class="w-full border border-gray-300 rounded-md p-2">{{ $comment->content }}</textarea>
                                <x-button type="submit" class="mt-2">Update</x-button>
                            </form>

                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                @csrf
                                @method('DELETE')
                                <x-button color="red" type="submit" class="mt-2">Delete</x-button>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach

            {{ $comments->links() }}
        </div>
    </div>

    @if (auth()->check() && auth()->id() === $blog->user_id)
        <div class="w-full flex justify-end items-center mt-6 gap-4">
            <x-button variant="outline" link href="/blogs/{{ $blog->slug }}/edit">Edit Blog</x-button>

            <form action="/blogs/{{ $blog->id }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this blog?');">
                @csrf
                @method('DELETE')
                <x-button color="red" type="submit">Delete Blog</x-button>
            </form>
        </div>
    @elseif(auth()->check())
        <div class="w-full flex justify-end items-center mt-6 gap-4">
            <form action="{{ $isSaved ? route('saved-posts.remove', $blog->id) : route('saved-posts.save', $blog->id) }}"
                method="POST">
                @csrf
                @if ($isSaved)
                    @method('DELETE')
                @endif
                <x-button variant="outline" type="submit">
                    {{ $isSaved ? 'Unsave Blog' : 'Save Blog' }}
                </x-button>
            </form>
        </div>
    @endif
@endsection
