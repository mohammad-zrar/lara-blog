<x-layout>
    <header class="flex flex-col md:flex-row gap-2 md:gap-8">
        <div class="grid justify-center md:justify-start h-fit">
            <img class="w-[140px] min-w-[140px] rounded-full shadow-lg border"
                src="{{ url('storage', $user->profile_picture) }}" alt="Profile Picture">

            @if ($isMine)
                <a href="{{ route('profile.edit', $user->username) }}"
                    class="my-2 px-2 py-1 bg-orange-600 text-white rounded-md shadow-md hover:bg-orange-500 transition text-center w-32 h-8">
                    Edit Profile
                </a>
            @elseif(auth()->check())
                <div class="flex justify-center">
                    @if (auth()->user()->following->contains($user))
                        <form method="POST" action="/users/{{ $user->id }}/unfollow" class="mt-2">
                            @csrf
                            <button
                                class="my-2 px-2 py-1 border border-orange-600 text-orange-600 rounded-md shadow-md hover:bg-orange-100 transition text-center w-32 h-8">
                                Unfollow
                            </button>
                        </form>
                    @else
                        <form method="POST" action="/users/{{ $user->id }}/follow" class="mt-2">
                            @csrf
                            <button
                                class="my-2 px-2 py-1 bg-orange-600 text-white rounded-md shadow-md hover:bg-orange-500 transition text-center w-32 h-8">
                                Follow
                            </button>
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
                    <a href="/blogs/create"
                        class="my-2 px-2 py-1 bg-orange-600 text-white rounded-md shadow-md hover:bg-orange-500 transition text-center w-32 h-8">
                        Create Blog
                    </a>
                </div>
            @endauth

            <div class="grid gap-4 mt-4">

                @forelse ($blogs as $blog)
                    <x-blog-card :title="$blog->title" :author="$blog->user->full_name" :publishedAt="$blog->created_at->format('d M Y')" :category="$blog->category"
                        :tags="$blog->tags->pluck('name')->toArray()" />
                @empty
                    <p class="text-center text-gray-500">No blogs to display.</p>
                @endforelse
            </div>
        </div>
        <div id="content-saved" class="tab-content hidden">
            <!-- Saved Blogs Placeholder -->
            <p class="text-center text-gray-500">No saved blogs yet.</p>
        </div>
        <div id="content-followers" class="tab-content hidden">
            <!-- Followers Placeholder -->
            <ul>
                @for ($i = 1; $i <= 5; $i++)
                    <li class="text-gray-700">Follower {{ $i }}</li>
                @endfor
            </ul>
        </div>
        <div id="content-following" class="tab-content hidden">
            <!-- Following Placeholder -->
            <ul>
                @for ($i = 1; $i <= 5; $i++)
                    <li class="text-gray-700">Following {{ $i }}</li>
                @endfor
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

</x-layout>
