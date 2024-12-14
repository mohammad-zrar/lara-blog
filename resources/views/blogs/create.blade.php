<x-layout>
    <div class="max-w-4xl mx-auto ">
        <h1 class="text-3xl font-bold text-orange-800 mb-6">Create a New Blog</h1>

        <form method="POST" action="/blogs" id="create-post-form" class="space-y-2">
            @csrf

            <!-- Title -->
            <div>
                <x-form-label for="title">Blog Title</x-form-label>
                <x-form-input name="title" id="title" placeholder="Enter the blog title" maxlength="100" required />
                <x-form-error name="title" />
            </div>

            <!-- Markdown Editor -->
            <div>
                <x-form-label for="content">Blog Content</x-form-label>
                <div id="editor" class="border border-orange-300 rounded-sm"></div>
                <textarea name="content" id="content" class="hidden"></textarea>
                <x-form-error name="content" />
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit"
                    class="px-4 py-2 bg-orange-600 text-white rounded-md shadow-md hover:bg-orange-500 transition">
                    Publish Blog
                </button>
            </div>
        </form>
    </div>

</x-layout>
