@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('password.update') }}" class="grid gap-2 p-8 w-full md:w-[35%] lg:w-[45%] mx-auto">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="">
            <x-form-label for="email">Email</x-form-label>
            <x-form-input name="email" class="placeholder:text-orange-300" id="email" type="email" :value="old('email')"
                placeholder="Enter your email address" required />
            <x-form-error name="email" />
        </div>

        <div class="">
            <x-form-label for="password">Password</x-form-label>
            <x-form-input name="password" class="placeholder:text-orange-300" id="password" type="password"
                placeholder="Enter your new password" required />
            <x-form-error name="password" />
        </div>

        <div class="">
            <x-form-label for="password_confirmation">Confirm Password</x-form-label>
            <x-form-input name="password_confirmation" class="placeholder:text-orange-300" id="password_confirmation"
                type="password" placeholder="Confirm your new password" required />
            <x-form-error name="password_confirmation" />
        </div>

        <div class="flex justify-between gap-2 mt-2">
            <x-button class="w-full" type="submit">Reset Password</x-button>
        </div>
    </form>
@endsection
