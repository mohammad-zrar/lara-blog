@extends('layouts.app')
@section('content')
    <h1 class="text-3xl text-orange-950 font-bold">
        {{ $blog->title }}
        <span class="text-2xl text-orange-900 font-semibold">({{ $blog->reading_time }} min)</span>
    </h1>

    <p class="text-orange-900">
        Created at {{ $blog->created_at->format('F j, Y ') }} by
        <a class="underline hover:text-orange-800" href="/{{ $blog->user->username }}">
            {{ $blog->user->full_name }}
        </a>
    </p>

    <p class="text-orange-800">Updated At {{ $blog->updated_at->format('F j, Y ') }}</p>

    <div class="p-4 shadow-md border border-gray-200 mt-4 text-lg overflow-auto whitespace-pre-wrap">
        {!! Str::markdown($blog->content) !!}
    </div>

    @if (auth()->check() && auth()->id() === $blog->user_id)
        <div class="w-full flex justify-end items-center mt-6 gap-4">
            <x-button variant="outline" link href="/blogs/{{ $blog->slug }}/edit">Edit Blog</x-button>
            <x-button color="red">Delete Blog</x-button>
        </div>
    @endif
@endsection
