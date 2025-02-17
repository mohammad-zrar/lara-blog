@extends('layouts.app')
@section('content')
    <form method="POST" action="/sign-up" enctype="multipart/form-data"
        class="grid gap-2 p-8 w-full md:w-[35%] lg:w-[45%] mx-auto ">
        @csrf

        <div class="">
            <x-form-label for="full_name">Full Name</x-form-label>
            <x-form-input name="full_name" class="placeholder:text-orange-300" id="full_name" :value="old('full_name')"
                placeholder="Enter your full name" required />
            <x-form-error name="full_name" />
        </div>

        <div class="">
            <x-form-label for="username">Username</x-form-label>
            <x-form-input name="username" class="placeholder:text-orange-300" id="username" :value="old('username')"
                placeholder="Choose a unique username" required />
            <x-form-error name="username" />
        </div>

        <div class="">
            <x-form-label for="email">Email</x-form-label>
            <x-form-input name="email" class="placeholder:text-orange-300" id="email" type="email" :value="old('email')"
                placeholder="example@example.com" required />
            <x-form-error name="email" />
        </div>

        <div class="relative">
            <x-form-label for="profile_picture">Profile Picture (Optional)</x-form-label>
            <div class="flex items-center">
                <input type="file" name="profile_picture" id="profile_picture" class="hidden"
                    accept="image/png, image/jpeg, image/webp" onchange="showFileName(event)" />

                <label for="profile_picture"
                    class="bg-orange-500 text-white px-2 py-1 rounded-sm cursor-pointer hover:bg-orange-600 transition-all">
                    Choose File
                </label>

                <span id="file-name" class="text-sm text-orange-900/90 ms-2">No file chosen</span>
            </div>
            <x-form-error name="profile_picture" />
        </div>

        <div class="">
            <x-form-label for="password">Password</x-form-label>
            <x-form-input name="password" class="placeholder:text-orange-300" id="password" type="password"
                placeholder="Create a strong password" required />
            <x-form-error name="password" />
        </div>

        <div class="">
            <x-form-label for="password_confirmation">Password Confirmation</x-form-label>
            <x-form-input name="password_confirmation" class="placeholder:text-orange-300" id="password_confirmation"
                type="password" placeholder="Confirm your password" required />
            <x-form-error name="password_confirmation" />
        </div>

        <div class="flex justify-between gap-2 mt-2">
            <x-button class="w-full" type="submit">Sign
                Up</x-button>
            <x-button class="w-full text-center" link href='/sign-in' variant="flat">Sign
                In</x-button>
        </div>
    </form>

    <script>
        function showFileName(event) {
            const input = event.target;
            const fileName = input.files[0]?.name || 'No file chosen';
            document.getElementById('file-name').textContent = fileName;
        }
    </script>
@endsection
