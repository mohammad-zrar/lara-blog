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

    <nav class="text-orange-800 py-4 mx-auto flex justify-between items-center max-w-[1280px]">
        <a href="/"
            class="text-2xl py-1 px-2 border border-orange-800 hover:bg-red-50 rounded-sm font-bold shadow transition-colors delay-75 ease-in-out">
            Lara Blog
        </a>
        <ul class="flex space-x-6">
            @auth
                <li>
                    <a href="/profile"
                        class="text-lg pb-1 border-2 border-transparent hover:border-b-orange-800 transition-colors duration-75 ">Profile</a>
                </li>
                <li>
                    <button type="submit"
                        class="text-lg pb-1 border-2 border-transparent hover:border-b-orange-800 transition-colors duration-75">Sign
                        Out</button>
                </li>
            @endauth

            @guest
                <li>
                    <x-nav-link href='/sign-in' :active="request()->is('sign-in')">Sign In</x-nav-link>
                </li>
                <li>
                    <x-nav-link href='/sign-up' :active="request()->is('sign-up')">Sign Up</x-nav-link>
                </li>
            @endguest


        </ul>
    </nav>


    <main class="py-6  mx-auto max-w-[1280px]">
        {{ $slot }}
    </main>

</body>

</html>
