<x-guest-layout>
    <form method="POST" action="{{ route('student.register.store') }}">
        @csrf
        <!--    Username -->
        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Student number-->
        <div class="mt-4">
            <x-input-label for="student_number" :value="__('Student Number')" />
            <x-text-input id="student_number" class="block mt-1 w-full" type="text" name="student_number" :value="old('student_number')" required autofocus autocomplete="student_number" />
            <x-input-error :messages="$errors->get('student_number')" class="mt-2" />
        </div>

        <!--Group-->
        <div class="mt-4">
            <x-input-label for="group" :value="__('Group')" />
            <select id="group" name="group" class="block mt-1 w-full" required>
                <option value="">  </option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                <option value="F">F</option>
            </select>
            <x-input-error :messages="$errors->get('group')" class="mt-2" />
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

        <!-- course -->
        <div class="mt-4">
            <x-input-label for="course" :value="__('Course')" />
            <select id="course" name="course" class="block mt-1 w-full" required>
                <option value="">  </option>
                <option value="ICS">ICS</option>
                <option value="BBIT">BBIT</option>
                <option value="LAW">Law</option>
                <option value="Philisophy">Philisophy</option>
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
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('student.login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Sign Up') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
