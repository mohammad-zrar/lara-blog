@extends('layouts.app')
@section('content')
    <h1 class="text-3xl text-orange-950 font-bold">
        {{ $blog->title }}
        <span class="text-2xl text-orange-900 font-semibold">({{ $blog->reading_time }} min)</span>
    </h1>

    <p class="text-orange-900">
        Category:
        <a class="underline hover:text-orange-800" href="/categories/{{ $blog->category->slug }}">
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



    @if (auth()->check() && auth()->id() === $blog->user_id)
        <div class="w-full flex justify-end items-center mt-6 gap-4">
            <x-button variant="outline" link href="/blogs/{{ $blog->slug }}/edit">Edit Blog</x-button>

            <form action="/blogs/{{ $blog->id }}" method="POST">
                @csrf
                @method('DELETE')
                <x-button color="red" type="submit">Delete Blog</x-button>
            </form>
        </div>
    @endif
@endsection
