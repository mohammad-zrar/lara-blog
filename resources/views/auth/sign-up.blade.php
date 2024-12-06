<x-layout>

    <form method="POST" action="/sign-in" class="w-[90%] md:w-[60%] lg:w-[30%] mx-auto grid space-y-4 ">
        @csrf

        <div class="">
            <x-form-label for="full_name">Full Name</x-form-label>
            <x-form-input name="full_name" id="full_name" :value="old('full_name')" required />
            <x-form-error name="full_name" />
        </div>

        <div class="">
            <x-form-label for="email">Email</x-form-label>
            <x-form-input name="email" id="email" type="email" :value="old('email')" required />
            <x-form-error name="email" />
        </div>

        <div class="">
            <x-form-label for="email_confirmation">Email Confirmation</x-form-label>
            <x-form-input name="email_confirmation" id="email_confirmation" type="email" :value="old('email')" required />
            <x-form-error name="email" />
        </div>

        <div class="">
            <x-form-label for="username">Username</x-form-label>
            <x-form-input name="username" id="username" :value="old('username')" required />
            <x-form-error name="username" />
        </div>

        <div class="">
            <x-form-label for="passwrod">Password</x-form-label>
            <x-form-input name="password" id="password" type="password" required />
            <x-form-error name="password" />
        </div>
        <div class="">
            <x-form-label for="password_confirmation">Password Confirmation</x-form-label>
            <x-form-input name="password_confirmation" id="password_confirmation" type="password" required />
            <x-form-error name="password_confirmation" />
        </div>
        <div class="grid grid-cols-2 gap-2 text-center pt-3">
            <button type="submit"
                class="bg-orange-600 hover:bg-orange-600/90 text-gray-50 px-2 py-1 rounded-sm  transition-all">Sign
                Up</button>
            <a href='/sign-in'
                class="hover:bg-orange-50 text-orange-600 hover:text-orange-600/90 px-2 py-1 rounded-sm cursor-pointer transition-all">Sign
                In</a>
        </div>
    </form>

</x-layout>
