<x-layout>
    <header>
        {{ $user }}
        {{ $isMine }}
        <pre>{{ asset($user->profile_picture) }}</pre>

        <img width="400px" height="400px" src="{{ asset($user->profile_picture) }}" alt="">
        <img data-src= "{{ Storage::get('public/images/' . $user->profile_picture) }}" alt="Card image cap">





    </header>
</x-layout>
