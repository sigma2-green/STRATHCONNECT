@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 px-6">

    <div class="text-center max-w-3xl w-full">


        <!-- BUTTONS -->
 <div class="mt-10 flex justify-center gap-6 flex-wrap">

    <!-- LOGIN -->
    <a href="{{ route('student.login') }}"
       class="w-48 h-44 flex flex-col items-center justify-center rounded-2xl bg-green-600 text-white shadow-lg hover:scale-105 hover:shadow-xl transition-all duration-300">

        <i class="fas fa-right-to-bracket text-4xl mb-4"></i>

        <span class="font-bold text-xl">Login</span>
        <span class="text-sm text-blue-100 mt-1">
            Access your account
        </span>

    </a>

    <!-- SIGN UP -->
    <a href="{{ route('student.register') }}" class="w-48 h-44 flex flex-col items-center justify-center rounded-2xl bg-green-600 text-white shadow-lg hover:scale-105 hover:shadow-xl transition-all duration-300">

        <i class="fas fa-user-plus text-4xl mb-4"></i>

        <span class="font-bold text-xl">Sign Up</span>
        <span class="text-sm text-green-100 mt-1">
            Create an account
        </span>

    </a>

    <!-- ADMIN LOGIN -->
    <a href="{{ route('admin.login') }}"
       class="w-48 h-44 flex flex-col items-center justify-center rounded-2xl bg-green-600 text-white shadow-lg hover:scale-105 hover:shadow-xl transition-all duration-300">

        <i class="fas fa-user-shield text-4xl mb-4"></i>

        <span class="font-bold text-xl">Admin</span>
        <span class="text-sm text-slate-300 mt-1">
            Staff access only
        </span>

    </a>

</div>
</div>
</div>
@endsection