@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 p-6">

    <div class="max-w-5xl mx-auto">

        <h1 class="text-3xl font-bold text-center mb-8">
            Student Dashboard
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- LEFT COLUMN -->
            <div class="space-y-4">

                <a href="{{ route('student.dashboard') }}"
                   class="w-full h-28 flex items-center gap-4 rounded-2xl bg-blue-600 text-white px-6 shadow-lg hover:scale-[1.02] transition">
                    <span class="text-3xl">📢</span>
                    <div>
                        <div class="font-bold text-lg">Announcements</div>
                        <div class="text-sm opacity-80">View latest news</div>
                    </div>
                </a>

                <a href="#"
                   class="w-full h-28 flex items-center gap-4 rounded-2xl bg-green-600 text-white px-6 shadow-lg hover:scale-[1.02] transition">
                    <span class="text-3xl">📅</span>
                    <div>
                        <div class="font-bold text-lg">Events</div>
                        <div class="text-sm opacity-80">See upcoming events</div>
                    </div>
                </a>

                <a href="#"
                   class="w-full h-28 flex items-center gap-4 rounded-2xl bg-purple-600 text-white px-6 shadow-lg hover:scale-[1.02] transition">
                    <span class="text-3xl">👥</span>
                    <div>
                        <div class="font-bold text-lg">Groups</div>
                        <div class="text-sm opacity-80">Join student groups</div>
                    </div>
                </a>

            </div>

            <!-- RIGHT COLUMN -->
            <div class="space-y-4">

                <a href="#"
                   class="w-full h-28 flex items-center gap-4 rounded-2xl bg-orange-600 text-white px-6 shadow-lg hover:scale-[1.02] transition">
                    <span class="text-3xl">📚</span>
                    <div>
                        <div class="font-bold text-lg">Courses</div>
                        <div class="text-sm opacity-80">View enrolled units</div>
                    </div>
                </a>

                <a href="#"
                   class="w-full h-28 flex items-center gap-4 rounded-2xl bg-red-600 text-white px-6 shadow-lg hover:scale-[1.02] transition">
                    <span class="text-3xl">📝</span>
                    <div>
                        <div class="font-bold text-lg">Assignments</div>
                        <div class="text-sm opacity-80">Track coursework</div>
                    </div>
                </a>

                <a href="#"
                   class="w-full h-28 flex items-center gap-4 rounded-2xl bg-slate-700 text-white px-6 shadow-lg hover:scale-[1.02] transition">
                    <span class="text-3xl">⚙️</span>
                    <div>
                        <div class="font-bold text-lg">Settings</div>
                        <div class="text-sm opacity-80">Manage profile</div>
                    </div>
                </a>

            </div>

        </div>

    </div>
</div>
@endsection