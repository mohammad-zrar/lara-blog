<x-layout>
    <header class="flex:col md:flex justify-center items-center gap-8">
        <div class="flex justify-center md:justify-start"> <img class="w-64 rounded-full shadow-lg border "
                src="{{ url('storage', $user->profile_picture) }}" alt="">
        </div>
        <div class="grid">
            <h1 class="text-4xl mx-auto  md:mx-0 inline">{{ $user->full_name }}</h1>
            <p class="text-2xl mx-auto  md:mx-0 text-gray-500 ">{{ $user->username }}</p>

            <p class="text-base mx-auto  md:mx-0">{{ $user->bio }}</p>
        </div>
    </header>
</x-layout>
