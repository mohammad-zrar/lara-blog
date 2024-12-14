<x-layout>
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-orange-800 mb-6">Create a New Blog</h1>

        <form method="POST" action="{{ route('blog.store') }}" id="create-post-form" class="space-y-2">
            @csrf

            <!-- Title -->
            <div>
                <x-form-label for="title">Blog Title</x-form-label>
                <x-form-input name="title" id="title" placeholder="Enter the blog title" maxlength="100" required />
                <x-form-error name="title" />
            </div>

            <!-- Select Category -->
            <div>
                <x-form-label for="category">Category (Optional)</x-form-label>
                <select name="category" id="category"
                    class="bg-orange-50/50 border border-orange-300 text-orange-900 text-sm rounded-sm focus:ring-1 focus:ring-orange-600 focus:border-orange-500 block w-full py-1 px-2 outline-none">
                    <option value="" disabled selected>Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <x-form-error name="category" />
            </div>

            <!-- Select Tags -->
            <div id="tags-container" class="hidden">
                <x-form-label for="tags">Tags (Optional)</x-form-label>
                <select name="tags[]" id="tags" multiple
                    class="bg-orange-50/50 border border-orange-300 text-orange-900 text-sm rounded-sm focus:ring-1 focus:ring-orange-600 focus:border-orange-500 block w-full py-1 px-2 outline-none">
                </select>
                <x-form-error name="tags" />
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

    <!-- JavaScript for Dynamic Tags -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const categorySelect = document.getElementById("category");
            const tagsSelect = document.getElementById("tags");
            const tagsContainer = document.getElementById("tags-container");

            categorySelect.addEventListener("change", async function() {
                const categoryId = this.value;

                // If no category selected, hide the tags dropdown
                if (!categoryId) {
                    tagsContainer.classList.add("hidden");
                    return;
                }

                // Fetch tags for the selected category
                try {
                    const response = await fetch(`/api/categories/${categoryId}/tags`);
                    const tags = await response.json();

                    // Clear and populate the tags dropdown
                    tagsSelect.innerHTML = "";
                    tags.forEach(tag => {
                        const option = document.createElement("option");
                        option.value = tag.id;
                        option.textContent = tag.name;
                        tagsSelect.appendChild(option);
                    });

                    // Show the tags dropdown
                    tagsContainer.classList.remove("hidden");
                } catch (error) {
                    console.error("Failed to fetch tags:", error);
                }
            });
        });
    </script>
</x-layout>
