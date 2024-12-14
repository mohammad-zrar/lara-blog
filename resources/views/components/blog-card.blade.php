@props(['title', 'author', 'publishedAt', 'categories', 'tags'])

<div
    class="flex flex-col md:flex-row items-start gap-4 p-6 w-full bg-white shadow-lg border border-gray-200 rounded-lg transition hover:shadow-xl cursor-pointer ">
    <!-- Text Section -->
    <div class="flex-1">
        <h3 class="text-2xl font-semibold text-gray-800 hover:text-orange-600 transition">
            {{ $title }}
        </h3>
        <p class="mt-1 text-sm text-gray-600">
            By: <span class="underline underline-offset-4 text-gray-800 hover:text-orange-500 transition">
                {{ $author }}
            </span>
        </p>
        <p class="mt-2 text-sm text-gray-500 md:mt-4 md:block hidden">
            Published At {{ $publishedAt }}
        </p>
    </div>

    <!-- Info Section -->
    <div class="flex flex-col md:items-end">
        <!-- Category -->
        <p class="text-sm font-medium text-gray-600 mb-2">
            {{ $categories ?? '(No Category)' }}
        </p>

        <!-- Tags -->
        <div class="flex flex-wrap gap-2">
            @foreach ($tags as $tag)
                <span
                    class="border border-orange-200 px-3 py-1 rounded-full text-sm text-gray-800 bg-orange-50 hover:bg-orange-100 transition">
                    {{ $tag }}
                </span>
            @endforeach
        </div>

        <!-- Publish Date for Small Screens -->
        <p class="mt-3 text-sm text-gray-500 block md:hidden">
            Published At {{ $publishedAt }}
        </p>
    </div>
</div>
