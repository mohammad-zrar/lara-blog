<x-layout>

    <form method="POST" action="/sign-in" class="w-[90%] md:w-[60%] lg:w-[30%] mx-auto grid space-y-4 ">
        @csrf

        <div class="">
            <x-form-label for="email">Email</x-form-label>
            <x-form-input name="email" id="email" type="email" :value="old('email')" required />
            <x-form-error name="email" />
        </div>

        <div class="">
            <x-form-label for="passwrod">Password</x-form-label>
            <x-form-input name="password" id="password" type="password" required />
            <x-form-error name="password" />
        </div>
        <div class="grid grid-cols-2 gap-2 text-center pt-3">
            <button type="submit"
                class="bg-orange-600 hover:bg-orange-600/90 text-gray-50 px-2 py-1 rounded-sm  transition-all">Sign
                In</button>
            <a href='/sign-up'
                class="hover:bg-orange-50 text-orange-600 hover:text-orange-600/90 px-2 py-1 rounded-sm cursor-pointer transition-all">Sign
                Up</a>
        </div>
        <div class="text-center text-orange-800 hover:text-orange-800/75 underline transition-all">
            <a href="/forgot-password">Forgot Password</a>
        </div>

    </form>

</x-layout>
