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
            <a href="{{ route('student.login') }}"
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



<!-- HERO VIDEO -->
<div class="mt-10 w-full">
    <div class="relative overflow-hidden rounded-3xl shadow-2xl">
        <!-- Can I have an appealing home page no video -->
        <div class="p-10 text-center">

            <h1 class="text-4xl font-bold text-gray-800 mb-4">Welcome to STRATHCONNECT</h1>
            <p class="text-lg text-gray-600 mb-6">Access your groups, courses, and more.</p>
        </div>
                  

 
    

    </div>
</div>
</div>
@endsection