<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lara Blog</title>
    @vite(['resources/js/app.js'])
</head>

<body class="min-h-screen">

    <nav
        class="text-orange-800 py-4 px-2 md:px-4 mx-auto flex justify-between items-center max-w-[1024px] whitespace-nowrap">
        <a href="/"
            class="text-xl md:text-2xl py-1 px-2 border border-orange-800 hover:bg-red-50 rounded-sm font-bold shadow transition-colors delay-75 ease-in-out">
            Lara Blog
        </a>
        <ul class="flex space-x-6">
            @auth
                <li>
                    <x-layouts.nav-link href="/{{ auth()->user()->username }}" :active="request()->is('' . auth()->user()->username)">
                        My Profile
                    </x-layouts.nav-link>
                </li>

                <li>
                    <form method="POST" action="/sign-out">
                        @csrf
                        @method('DELETE')
                        <button
                            class="text-base md:text-lg pb-1 
           transition-all duration-75 hover:text-red-600  font-semibold">Sign
                            Out</button>
                    </form>
                </li>
            @endauth

            @guest
                <li>
                    <x-layouts.nav-link href='/sign-in' :active="request()->is('sign-in')">Sign In</x-layouts.nav-link>
                </li>
                <li>
                    <x-layouts.nav-link href='/sign-up' :active="request()->is('sign-up')">Sign Up</x-layouts.nav-link>
                </li>
            @endguest

        </ul>
    </nav>

    <main class="py-6 px-4  mx-auto max-w-[1024px]">
        @yield('content')
    </main>

    <footer class="absolute bottom-0 left-0 bg-orange-600 text-orange-50 w-full flex justify-center py-4">
        <p>&copy; 2025 My Laravel Blog Post</p>
    </footer>

</body>

</html>
