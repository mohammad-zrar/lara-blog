<x-layout>
    <form method="POST" action="/signin" class="row justify-center mx-auto">
        @csrf

        <div class="space-y-12 pe-8">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="sm:col-span-4">
                    <x-form-label for="email">Email</x-form-label>
                    <div class="mt-2">
                        <x-form-input name="email" id="email" type="email" :value="old('email')" required />
                        <x-form-error name="email" />
                    </div>
                </div>

                <div class="sm:col-span-4">
                    <x-form-label for="passwrod">Password</x-form-label>
                    <div class="mt-2">
                        <x-form-input name="password" id="password" type="password" required />
                        <x-form-error name="password" />
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6 px-8">
            <x-form-button>Log In</x-form-button>
        </div>
    </form>
</x-layout>
