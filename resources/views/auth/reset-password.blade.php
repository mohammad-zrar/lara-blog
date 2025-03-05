@extends('layouts.app')

@section('content')
    <form method="POST" action="/reset-password" class="grid gap-2 p-8 w-full md:w-[35%] lg:w-[45%] mx-auto">
        @csrf

        <div class="">
            <x-form-label for="token">Token</x-form-label>
            <x-form-input name="token" class="placeholder:text-orange-300" id="token" type="text"
                placeholder="Enter the token you received" required />
            <x-form-error name="token" />
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
