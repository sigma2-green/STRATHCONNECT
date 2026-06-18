@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 px-6">

    <div class="text-center max-w-3xl w-full">

        <!-- TITLE -->
        <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 tracking-tight">
            StrathConnect
        </h1>

        <p class="mt-5 text-lg text-gray-600">
            The modern communication hub for students and lecturers at Strathmore University.
        </p>

        <!-- BUTTONS -->
        <div class="mt-10 flex justify-center gap-6 flex-wrap">

            <!-- LOGIN -->
            <a href="{{ route('student.login.submit') }}"
               class="w-44 h-40 flex flex-col items-center justify-center rounded-2xl bg-blue-600 text-white shadow-lg hover:scale-105 transition">

                <span class="text-3xl mb-2">🔐</span>
                <span class="font-bold text-lg">Login</span>
                <span class="text-xs opacity-80 mt-1">Access your account</span>

            </a>

            <!-- SIGN UP -->
            <a href="{{ route('student.register') }}"
               class="w-44 h-40 flex flex-col items-center justify-center rounded-2xl bg-green-600 text-white shadow-lg hover:scale-105 transition">

                <span class="text-3xl mb-2">📝</span>
                <span class="font-bold text-lg">Sign Up</span>
                <span class="text-xs opacity-80 mt-1">Create new account</span>

            </a>

            <!-- ADMIN LOGIN - ADD THIS -->
            <a href="{{ route('admin.login') }}"
               class="w-44 h-40 flex flex-col items-center justify-center rounded-2xl bg-gray-800 text-white shadow-lg hover:scale-105 transition">

                <span class="text-3xl mb-2">👑</span>
                <span class="font-bold text-lg">Admin</span>
                <span class="text-xs opacity-80 mt-1">Staff access only</span>

            </a>



        </div>

        <!-- FOOTER TEXT -->
        <p class="mt-12 text-sm text-gray-500">
            Everything you need for academic life in one place.
        </p>

    </div>
</div>
@endsection