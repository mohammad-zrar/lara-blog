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

    <!-- Toast UI Editor Integration -->
    <script src="https://uicdn.toast.com/editor/latest/toastui-editor-all.min.js"></script>
    <link rel="stylesheet" href="https://uicdn.toast.com/editor/latest/toastui-editor.min.css">

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const editor = new toastui.Editor({
                el: document.querySelector('#editor'),
                height: '400px',
                initialEditType: 'markdown',
                placeholder: 'Write something cool!',
            });

            const form = document.querySelector('#create-post-form');
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                document.querySelector('#content').value = editor.getMarkdown();
                form.submit();
            });
        });
    </script>
</x-layout>
