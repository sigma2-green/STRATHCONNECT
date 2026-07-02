<nav x-data="{ open: false }"
     class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- LEFT SIDE -->
            <div class="flex items-center">

                @auth('lecturer')
                    <!-- USER AVATAR -->
                    <div class="w-12 aspect-square  text-black  dark:text-white text-lg font-bold uppercase flex items-center justify-center flex-shrink-0" style="font-family: 'Times New Roman', Times, serif;">
                        {{ strtoupper(substr(Auth::guard('lecturer')->user()->name, 0, 100)) }}
                    </div>
                @else
                    <!-- LOGO -->
                    <a href="{{ route('home') }}"
                       class="text-xl font-bold text-blue-600 dark:text-blue-400">
                        StrathConnect
                    </a>
                @endauth
            </div>

            <!-- RIGHT SIDE -->
            <div class="hidden md:flex space-x-3 items-center">



                <!-- AUTHENTICATED LECTURER LINKS -->
                @auth('lecturer')


                    <a href="{{ route('lecturer.events.index') }}"
                       class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 border-black border-2 rounded-lg px-3 py-1">
                        events
                    </a>

                    <a href="{{ route('lecturer.dashboard') }}"
                       class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 border-black border-2 rounded-lg px-3 py-1">
                        Dashboard
                    </a>

                    <a href="{{ route('lecturer.events.create') }}">
                        <button
                            class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 border-black border-2 rounded-lg px-3 py-1">
                            Create Event
                        </button>   
                    </a>

                    <form method="POST" action="{{ route('lecturer.logout') }}">
                        @csrf
                        <button type="submit"
                                class="text-red-500 hover:text-red-700 border-black border-2 rounded-lg px-3 py-1">
                            Logout
                        </button>
                    </form>

                    <!-- Theme Toggle -->
                <button id="themeToggle" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-200 dark:bg-slate-700 hover:bg-gray-300 dark:hover:bg-slate-600 transition duration-300" title="Toggle Dark Mode">
                   <span id="themeIcon" class="text-lg">🌙</span>
                </button>

                @endauth

                @guest
                    <a href="{{ route('lecturer.login') }}"
                       class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 border-black border-2 rounded-lg px-3 py-1">
                       Login
                    </a>

                    <a href="{{ route('lecturer.register') }}"
                       class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 border-black border-2 rounded-lg px-3 py-1">
                        Sign Up 
                    </a> 

                    <button id="themeToggle" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-200 dark:bg-slate-700 hover:bg-gray-300 dark:hover:bg-slate-600 transition duration-300" title="Toggle Dark Mode">
                      <span id="themeIcon" class="text-lg">🌙</span>
                    </button>
                @endguest
            

                



            </div>


        </div>
    </div>



</nav>

