<nav x-data="{ open: false }"
     class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- LOGO / USER AVATAR (LEFT) -->
<div class="flex items-center">

    @auth('student')
        <!-- USER AVATAR -->
        <div class="w-12 aspect-square rounded-full bg-blue-600 text-white text-lg font-bold uppercase flex items-center justify-center flex-shrink-0">
    {{ strtoupper(substr(Auth::guard('student')->user()->username, 0, 1)) }}
</div>
    @else
        <!-- LOGO -->
        <a href="{{ route('home') }}"
           class="text-xl font-bold text-blue-600 dark:text-blue-400">
            StrathConnect
        </a>
    @endauth

</div>

            <!-- NAV LINKS (RIGHT / CENTER ON DESKTOP) -->
            <div class="hidden md:flex space-x-3 items-center">

                <a href="{{ route('student.dashboard') }}"
                   class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 border-black border-2 rounded-lg px-3 py-1">
                    Dashboard
                </a>

                <a href="#"
                   class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 border-black border-2 rounded-lg px-3 py-1">
                    Announcements
                </a>

                <a href="#"
                   class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 border-black border-2 rounded-lg px-3 py-1">
                    Events
                </a>

                <a href="#"
                   class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 border-black border-2 rounded-lg px-3 py-1">
                    Groups
                </a>

                <!-- Profile -->
                <a href="{{ route('profile.edit') }}"
                   class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 border-black border-2 rounded-lg px-3 py-1">
                    Profile
                </a>

                <!-- Logout -->
                <form method="POST" action="{{ route('student.logout') }}">
                    @csrf
                    <button class="text-red-500 dark:text-red-500 hover:text-red-500 border-black border-2 rounded-lg px-3 py-1">
                        Logout
                    </button>
                </form>

            </div>


        </div>
    </div>



</nav>
