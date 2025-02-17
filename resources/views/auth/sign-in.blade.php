@extends('layouts.app')

@section('content')
    <form method="POST" action="/sign-in" class="grid gap-2 p-8 w-full md:w-[35%] lg:w-[45%] mx-auto ">
        @csrf

        <div>
            <x-form-label for="email">Email</x-form-label>
            <x-form-input name="email" id="email" type="email" :value="old('email')" required />
            <x-form-error name="email" />
        </div>

        <div>
            <x-form-label for="passwrod">Password</x-form-label>
            <x-form-input name="password" id="password" type="password" required />
            <x-form-error name="password" />
        </div>
        <div class="flex justify-between gap-2 mt-2">
            <x-button class="w-full" type="submit">Sign
                In</x-button>
            <x-button class="w-full text-center" link href='/sign-up' variant="flat">Sign
                Up</x-button>
        </div>
        <div class="text-center text-orange-800 hover:text-orange-800/75 underline transition-all">
            <a href="/forgot-password">Forgot Password</a>
        </div>

    </form>
@endsection
