<x-guest-layout>
    <!-- Session Status -->
    

    <form method="POST" action="{{ route('Lecturer.login.submit') }}">
        @csrf

        <!-- Username -->
        <div>
            <x-input-label for="name" :value="__('name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
           <x-text-input
    id="password"
    class="block mt-1 w-full border border-red-500 bg-white text-black"
    type="password"
    name="password"
    required
/>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

