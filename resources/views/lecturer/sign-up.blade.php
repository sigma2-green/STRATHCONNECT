<x-guest-layout>
    <form method="POST" action="{{ route('lecturer.register.store') }}">
        @csrf
        <!--    Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone number -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone Number')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autofocus autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

     <!-- Office number -->
        <div class="mt-4">
            <x-input-label for="office" :value="__('Office Number')" />
            <x-text-input id="office" class="block mt-1 w-full" type="text" name="office" :value="old('office')" required autofocus autocomplete="office" />
            <x-input-error :messages="$errors->get('office')" class="mt-2" />
        </div>  



        <!-- Staff number-->
        <div class="mt-4">
            <x-input-label for="staff" :value="__('Staff Number')" />
            <x-text-input id="staff" class="block mt-1 w-full" type="text" name="staff" :value="old('staff')" required autofocus autocomplete="staff" />
            <x-input-error :messages="$errors->get('staff')" class="mt-2" />
        </div>

        

        <!-- school -->
        <div class="mt-4">
            <x-input-label for="school" :value="__('School')" />
            <select id="school"  name="school" class="block mt-1 w-full" required>
                <option value="">  </option>
                <option value="SCES">SCES</option>
                <option value="SBS">SBS</option>
                <option value="SLS">SLS</option>
                <option value="SHS">SHS</option>    
            </select>
            <x-input-error :messages="$errors->get('school')" class="mt-2" />
        </div>

        <!-- Course -->
        <div class="mt-4">
            <x-input-label for="course" :value="__('Course')" />
            <select id="course" name="course" class="block mt-1 w-full" required>
                <option value="">  </option>
                <option value="ICS">ICS</option>
                <option value="BBIT">BBIT</option>
                <option value="LAW">Law</option>
                <option value="Philosophy">Philosophy</option>
                <option value="CNA">CNA</option>
            </select>
            <x-input-error :messages="$errors->get('course')" class="mt-2" />
        </div>  


        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('lecturer.login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Sign Up') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

