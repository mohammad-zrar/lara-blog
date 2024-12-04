<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lara Blog</title>
    @vite(['resources/js/app.js'])
</head>

<body>

    <nav class="text-orange-800 p-4 mx-auto flex justify-between items-center max-w-2xl">
        <a href="/" class="text-xl font-bold">Lara Blog</a>
        <ul class="flex space-x-4">
            @auth
                <li>
                    <a href="/profile" class="hover:underline">Profile</a>
                </li>
                <li>
                    <button type="submit" class="hover:underline">Sign Out</button>
                </li>
            @else
                <li>
                    <a href="#" class="hover:underline">Sign In</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">Sign Up</a>
                </li>
            @endauth
        </ul>
    </nav>

    <main class="py-6 max-w-[1440px] mx-auto">
        {{ $slot }}
    </main>

</body>

</html>
