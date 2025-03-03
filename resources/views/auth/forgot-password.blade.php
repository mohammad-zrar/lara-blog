@extends('layouts.app')

@section('content')
    <form method="POST" action="/forgot-password" class="grid gap-2 p-8 w-full md:w-[35%] lg:w-[45%] mx-auto">
        @csrf

        <div class="">
            <x-form-label for="email">Email</x-form-label>
            <x-form-input name="email" class="placeholder:text-orange-300" id="email" type="email" :value="old('email')"
                placeholder="Enter your email address" required />
            <x-form-error name="email" />
        </div>

        <div class="flex justify-between gap-2 mt-2">
            <x-button class="w-full" type="submit">Send Password Reset Link</x-button>
        </div>
    </form>
@endsection
