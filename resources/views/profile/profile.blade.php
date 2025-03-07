@extends('layouts.app')
@section('content')
    <header class="flex flex-col md:flex-row gap-2 md:gap-8">
        <div class="grid justify-center md:justify-start h-fit">
            <img class="w-[140px] min-w-[140px] rounded-full shadow-lg border"
                src="{{ $user->profile_picture ? '/storage/' . $user->profile_picture : '/images/default-avatar.png' }}"
                alt="Profile Picture">
            @if ($isMine)
                <x-button class="text-center" link href="{{ route('profile.edit', $user->username) }}">
                    Edit Profile
                </x-button>
            @elseif(auth()->check())
                <div class="flex justify-center">
                    @if (auth()->user()->following->contains($user))
                        <form method="POST" action="/users/{{ $user->id }}/unfollow" class="mt-2">
                            @csrf
                            <x-button variant="outline">
                                Unfollow
                            </x-button>
                        </form>
                    @else
                        <form method="POST" action="/users/{{ $user->id }}/follow" class="mt-2">
                            @csrf
                            <x-button>
                                Follow
                            </x-button>
                        </form>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex flex-col text-center md:text-start  ">
            <div class="mb-2">
                <h1 class="text-4xl md:mx-0 mb-1">{{ $user->full_name }}</h1>
                <p class="text-2xl text-gray-500 ">{{ $user->username }}</p>
            </div>
            <div>
                <p class="text-base ">{{ $user->bio }}</p>
            </div>

        </div>
    </header>

    <x-profile.tabs />

    <section id="content" class="">
        <div id="content-pinned" class="tab-content">

            @auth
                <div class="flex justify-end mt-2">
                    <x-button link href="/blogs/create">
                        Create Blog
                    </x-button>
                </div>
            @endauth

            <div class="grid gap-4 mt-4">

                @forelse ($blogs as $blog)
                    <x-blog-card :title="$blog->title" :author="$blog->user->full_name" :publishedAt="$blog->created_at->format('d M Y')" :category="$blog->category" :slug="$blog->slug"
                        :tags="$blog->tags->pluck('name')->toArray()" />
                @empty
                    <p class="text-center text-gray-500">No blogs to display.</p>
                @endforelse
            </div>
        </div>

        <div id="content-saved" class="tab-content hidden">
            <div class="grid gap-4 mt-4">

                @forelse ($savedBlogs as $blog)
                    <x-blog-card :title="$blog->title" :author="$blog->user->full_name" :publishedAt="$blog->created_at->format('d M Y')" :category="$blog->category" :slug="$blog->slug"
                        :tags="$blog->tags->pluck('name')->toArray()" />
                @empty
                    <p class="text-center text-gray-500">No saved blogs yet.</p>
                @endforelse
            </div>
        </div>


        <div id="content-followers" class="tab-content hidden">
            <ul class="space-y-2 mt-4">
                @forelse($user->followers as $follower)
                    <li class="flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2">
                            <img class="w-8 h-8 rounded-full"
                                src="{{ $follower->profile_picture ? '/storage/' . $follower->profile_picture : '/images/default-avatar.png' }}"
                                alt="Follower Profile Picture">
                            <span class="text-gray-700">{{ $follower->username }}</span>
                        </div>

                        @if (auth()->check() && auth()->user()->id !== $follower->id)
                            @if (auth()->user()->following->contains($follower))
                                <form method="POST" action="/users/{{ $follower->id }}/unfollow" class="ml-2">
                                    @csrf
                                    <x-button variant="outline">Unfollow</x-button>
                                </form>
                            @else
                                <form method="POST" action="/users/{{ $follower->id }}/follow" class="ml-2">
                                    @csrf
                                    <x-button>Follow</x-button>
                                </form>
                            @endif
                        @endif
                    </li>
                @empty
                    <li class="text-gray-500">No followers yet.</li>
                @endforelse
            </ul>
        </div>

        <div id="content-following" class="tab-content hidden">
            <ul class="space-y-2 mt-4">
                @forelse($user->following as $followedUser)
                    <li class="flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2">
                            <img class="w-8 h-8 rounded-full"
                                src="{{ $followedUser->profile_picture ? '/storage/' . $followedUser->profile_picture : '/images/default-avatar.png' }}"
                                alt="Following Profile Picture">
                            <span class="text-gray-700">{{ $followedUser->username }}</span>
                        </div>

                        @if (auth()->check() && auth()->user()->id !== $followedUser->id)
                            @if (auth()->user()->following->contains($followedUser))
                                <forx-button-button="POST" ax-buttontion="/users/{{ $followedUser->id }}/unfollow"
                                class="ml-2">
                                @csrf
                                <x-button variant="outline">Unfollow</x-button>
                                </form>
                            @else
                                <form method="POST" action="/users/{{ $followedUser->id }}/follow" class="ml-2">
                                    @csrf
                                    <x-button>Follow</x-button>
                                </form>
                            @endif
                        @endif
                    </li>
                @empty
                    <li class="text-gray-500">No followings yet.</li>
                @endforelse
            </ul>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const tabs = document.querySelectorAll(".tab-button");
            const contents = document.querySelectorAll(".tab-content");

            tabs.forEach((tab, index) => {
                tab.addEventListener("click", () => {
                    // Remove active state from all tabs
                    tabs.forEach((t) => t.classList.remove("active"));

                    // Hide all tab contents
                    contents.forEach((content) => content.classList.add("hidden"));

                    // Activate the selected tab and content
                    tab.classList.add("active");
                    contents[index].classList.remove("hidden");
                });
            });
        });
    </script>
@endsection
