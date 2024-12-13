<x-layout>

    <div class="text-center mb-4">
        <h1 class="text-2xl font-bold text-orange-600">Edit Profile</h1>
    </div>

    <form method="POST" action="{{ route('profile.update', $user->username) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="relative flex flex-col items-center group">
            <!-- Clickable image -->
            <label for="profile_picture" class="cursor-pointer relative">
                <img id="preview" class="w-[140px] h-[140px] rounded-full shadow-lg border group-hover:opacity-50"
                    src="{{ url('storage', $user->profile_picture) }}" alt="Profile Picture">
                <!-- Hover effect -->
                <div
                    class="absolute inset-0 flex items-center justify-center bg-black/50 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 w-[140px] h-[140px]">
                    <span class="text-white text-sm font-medium">Change</span>
                </div>
            </label>
            <input type="file" name="profile_picture" id="profile_picture" accept="image/*" class="hidden"
                onchange="previewImage(event)">
            <x-form-error name="profile_picture" />
        </div>

        <div class="">
            <x-form-label for="full_name">Full Name</x-form-label>
            <x-form-input name="full_name" maxlength="50" class="placeholder:text-orange-300" id="full_name"
                value="{{ $user->full_name }}" required />
            <x-form-error name="full_name" />
        </div>

        <div class="mt-4">
            <x-form-label for="bio">Bio</x-form-label>
            <x-form-textarea maxlength="500" name="bio" class="placeholder:text-orange-300"
                id="bio">{{ old('bio', $user->bio) }} </x-form-textarea>
            <x-form-error name="bio" />
        </div>


        <div class="grid grid-cols-2 gap-2 text-center pt-3">
            <button type="submit"
                class="bg-orange-600 hover:bg-orange-600/90 text-gray-50 px-2 py-1 rounded-sm transition-all">Save</button>
            <a href="/{{ $user->username }}"
                class="hover:bg-orange-50 text-orange-600 hover:text-orange-600/90 px-2 py-1 rounded-sm cursor-pointer transition-all">Cancel</a>
        </div>

    </form>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result; // Update the image source
                };

                reader.readAsDataURL(input.files[0]); // Read the uploaded file
            }
        }
    </script>
    {{ $user->bio }}
</x-layout>
