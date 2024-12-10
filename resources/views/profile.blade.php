<x-layout>
    <header>
        {{-- {{ $user }} --}}
        {{-- {{ $isMine }} --}}
        {{-- <pre>Pass: {{ asset($user->profile_picture) }}</pre> --}}
        <pre>Test: {{ url('storage/', $user->profile_picture) }}</pre>
        <img src="{{ url('storage/', $user->profile_picture) }}" alt="">

    </header>
</x-layout>
