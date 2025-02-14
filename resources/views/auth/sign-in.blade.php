@extends('layouts.app')

@section('content')
    <form method="POST" action="/sign-in" class="grid gap-2">
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
        <div class="flex justify-between">
            <x-button type="submit">Sign
                In</x-button>
            <x-button link href='/sign-up' variant="flat">Sign
                Up</x-button>
        </div>
        <div class="text-center text-orange-800 hover:text-orange-800/75 underline transition-all">
            <a href="/forgot-password">Forgot Password</a>
        </div>

    </form>
@endsection
