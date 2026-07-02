<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Prevent Flash of Wrong Theme -->
    <script>
        if (
            localStorage.theme === 'dark' ||
            (!localStorage.theme &&
                window.matchMedia('(prefers-color-scheme: dark)').matches)
        ) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('images/strathConnect.png') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100 dark:bg-slate-950 text-gray-900 dark:text-white transition-colors duration-300">

<div class="min-h-screen flex flex-col">

    {{-- Navigation --}}
    @include('layouts.navigation')

    {{-- Header --}}
    @isset($header)
        <header class="bg-white dark:bg-slate-900 border-b border-gray-200 dark:border-slate-700">
            <div class="max-w-7xl mx-auto py-6 px-6 flex justify-between items-center">

                <h1 class="text-2xl font-bold">
                    {{ $header }}
                </h1>

                {{-- Theme Toggle --}}
                <button id="themeToggle"
                        class="w-11 h-11 rounded-full bg-gray-200 dark:bg-slate-700 hover:scale-105 transition">

                    <span id="themeIcon">🌙</span>

                </button>

            </div>
        </header>
    @endisset

    {{-- Main --}}
    <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">

        <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-lg border border-gray-200 dark:border-slate-700 p-6">

            @yield('content')

        </div>

    </main>

    {{-- Footer --}}
    <footer class="py-6 text-center text-sm text-gray-500 dark:text-gray-400">

        © {{ date('Y') }} StrathConnect • Strathmore University Communication System

    </footer>

</div>

</body>
</html>