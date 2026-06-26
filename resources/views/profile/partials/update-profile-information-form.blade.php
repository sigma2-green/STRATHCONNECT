<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Profile Information
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Update your profile information.
        </p>
    </header>

    <form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('PATCH')

        <div>
            <x-input-label for="student_number" :value="__('Student Number')" />
            <x-text-input
                id="student_number"
                name="student_number"
                type="text"
                class="mt-1 block w-full"
                :value="old('student_number', $user->student_number)"
                required
            />
            
            <x-input-error class="mt-2" :messages="$errors->get('student_number')" />
        </div>

        <div>
            <x-input-label for="username" :value="__('Username')" />

            <x-text-input
                id="username"
                name="username"
                type="text"
                class="mt-1 block w-full"
                :value="old('username', $user->username)"
                required
            />

            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />

            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full"
                :value="old('email', $user->email)"
                required
            />

            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>
                Save Changes
            </x-primary-button>
        </div>
    </form>
</section>