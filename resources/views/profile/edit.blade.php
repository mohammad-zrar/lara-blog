<x-layout>

    <form method='POST' action="{{ route('profile.update', $user->username) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div>
            <img class="w-[140px] min-w-[140px] rounded-full shadow-lg border"
                src="{{ url('storage', $user->profile_picture) }}" alt="">
        </div>


        <div>
            <x-form-label for="full_name">Full
                Name</x-form-label>
            <x-form-input name="full_name" maxlength="50" class="placeholder:text-orange-300" id="full_name"
                value="{{ $user->full_name }}" required />
            <x-form-error name="full_name" />
        </div>

        <div>
            <x-form-label for="bio">Bio</x-form-label>
            <x-form-textarea maxlength="500" name="bio" class="placeholder:text-orange-300" id="full_name"
                value="{{ $user->bio }}" />
            <x-form-error name="bio" />
        </div>

        <div class="grid grid-cols-2 gap-2 text-center pt-3">
            <button type="submit"
                class="bg-orange-600 hover:bg-orange-600/90 text-gray-50 px-2 py-1 rounded-sm  transition-all">Save</button>
            <a href="/{{ $user->username }}"
                class="hover:bg-orange-50 text-orange-600 hover:text-orange-600/90 px-2 py-1 rounded-sm cursor-pointer transition-all">Cancel</a>
        </div>

    </form>

</x-layout>
