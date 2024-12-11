<x-layout>
    <header class="md:flex justify-center items-center gap-8">
        <div class="grid justify-center md:justify-start">
            <img class="w-[140px] min-w-[140px] rounded-full shadow-lg border"
                src="{{ url('storage', $user->profile_picture) }}" alt="Profile Picture">

            @if ($isMine)
                <a href="{{ route('profile.edit', $user->username) }}"
                    class="my-2 px-2 py-1 bg-orange-600 text-white rounded-md shadow-md hover:bg-orange-500 transition text-center w-[140px]">
                    Edit Profile
                </a>
            @elseif(auth()->check())
                <div class="flex justify-center">
                    @if (auth()->user()->following->contains($user))
                        <form method="POST" action="/users/{{ $user->id }}/unfollow" class="mt-2">
                            @csrf
                            <button
                                class="my-2 px-2 py-1 border border-orange-600 text-orange-600 rounded-md shadow-md hover:bg-orange-100 transition text-center w-[140px]">
                                Unfollow
                            </button>
                        </form>
                    @else
                        <form method="POST" action="/users/{{ $user->id }}/follow" class="mt-2">
                            @csrf
                            <button
                                class="my-2 px-2 py-1 bg-orange-600 text-white rounded-md shadow-md hover:bg-orange-500 transition text-center w-[140px]">
                                Follow
                            </button>
                        </form>
                    @endif
                </div>
            @endif
        </div>

        <div class="grid">
            <h1 class="text-4xl md:mx-0">{{ $user->full_name }}</h1>
            <p class="text-2xl text-gray-500">{{ $user->username }}</p>
            <p class="text-base">{{ $user->bio }}</p>
        </div>
    </header>
    <section id="tabs"></section>
    <section id="content"></section>
</x-layout>
