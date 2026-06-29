<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - StrathConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white">
    <nav class="bg-slate-900 border-b border-slate-700 shadow-lg p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex space-x-6">
                <h1 class="text-2xl font-extrabold text-white tracking-wide">
                    StrathConnect Admin
                </h1>
                <a href="{{ route('admin.dashboard') }}" class="text-slate-300 hover:text-blue-400 transition font-semibold">Dashboard</a>
                <a href="{{ route('admin.students') }}" class="text-blue-600 hover:text-blue-800 transition font-semibold">Students</a>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
            </form>
        </div>
    </nav>
    
    <div class="max-w-7xl mx-auto py-10 px-6">
        <div class="mb-10">

            <h1 class="text-4xl font-bold text-white">
                👋 Welcome back, {{ Auth::guard('admin')->user()->name }}
            </h1>

            <p class="text-slate-300 mt-2 text-lg">
                 Manage students, announcements and campus communication from one place.
            </p>

        </div>
        
        <div class="grid grid-cols-2 gap-8 mb-10">
            <div class="bg-white rounded-2xl shadow-2xl border border-slate-200 p-6 hover:scale-[1.02] transition duration-300">
                <h3 class="text-slate-400 uppercase tracking-wider text-sm">Total Students</h3>
                <p class="text-5xl font-bold text-slate-900 mt-3">{{ $totalStudents }}</p>
                <a href="{{ route('admin.students') }}" class="text-blue-400 text-sm mt-4 inline-block hover:text-blue-300">View All →</a>
            </div>
            
            <div class="bg-white rounded-2xl shadow-2xl border border-slate-200 p-6 hover:scale-[1.02] transition duration-300">
                <h3 class="text-slate-400 uppercase tracking-wider text-sm">Total Admins</h3>
                <p class="text-5xl font-extrabold text-slate-900 mt-3">{{ $totalAdmins }}</p>
            </div>
        </div>
        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow p-6">

            <h2 class="text-2xl font-bold text-slate-800 mb-6">
                ⚡ Quick Actions
            </h2>

            <div class="grid md:grid-cols-2 gap-4">

                <a href="{{ route('admin.students') }}"
                    class="flex items-center justify-between bg-blue-600 hover:bg-blue-700 text-white rounded-xl p-5 transition">

                    <div>
                    <h3 class="font-bold text-lg">
                        👨‍🎓 Manage Students
                    </h3>

                    <p class="text-blue-100 text-sm">
                        View, edit and remove student accounts.
                    </p>
                </div>

                <span class="text-2xl">
                   →
                </span>

            </a>

            <a href="{{ route('admin.announcements.index') }}"
                class="flex items-center justify-between bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl p-5 transition">

                <div>
                    <h3 class="font-bold text-lg">
                        📢 Manage Announcements
                    </h3>

                    <p class="text-indigo-100 text-sm">
                        Create and publish announcements.
                    </p>
                </div>

                <span class="text-2xl">
                    →
                </span>

            </a>

        </div>

    </div>
</body>
</html>