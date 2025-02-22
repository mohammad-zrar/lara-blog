@extends('layouts.app')
@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold text-orange-800 mb-6">Blogs</h1>

        @if ($blogs->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($blogs as $blog)
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h2 class="text-xl font-semibold">{{ $blog->title }}</h2>
                        <p class="text-gray-600">Category: {{ $blog->category->name ?? 'Uncategorized' }}</p>
                        <a href="{{ route('showBlog', $blog->slug) }}" class="text-orange-600 hover:underline">Read more</a>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Links -->
            @if ($blogs->total() > 10)
                <div class="mt-6">
                    {{ $blogs->links() }}
                </div>
            @endif
        @else
            <p class="text-gray-600">No blogs available.</p>
        @endif
    </div>
@endsection
