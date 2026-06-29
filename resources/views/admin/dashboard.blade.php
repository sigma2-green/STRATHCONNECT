<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - StrathConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex space-x-6">
                <h1 class="text-xl font-bold">Admin Panel</h1>
                <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Dashboard</a>
                <a href="{{ route('admin.students') }}" class="text-blue-600 hover:text-blue-800">Students</a>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
            </form>
        </div>
    </nav>
    
    <div class="max-w-7xl mx-auto p-6">
        <h2 class="text-2xl font-bold mb-6">Welcome, {{ Auth::guard('admin')->user()->name }}</h2>
        
        <div class="grid grid-cols-2 gap-6 mb-8">
            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-gray-500">Total Students</h3>
                <p class="text-3xl font-bold">{{ $totalStudents }}</p>
                <a href="{{ route('admin.students') }}" class="text-blue-600 text-sm mt-2 inline-block">View All →</a>
            </div>
            
            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-gray-500">Total Admins</h3>
                <p class="text-3xl font-bold">{{ $totalAdmins }}</p>
                <a href="{{ route('admin.index') }}" class="text-blue-600 text-sm mt-2 inline-block">View All →</a>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-gray-500">Total Lecturers</h3>
                <p class="text-3xl font-bold">{{ $totalLecturers }}</p>
                <a href="{{ route('admin.lecturers') }}" class="text-blue-600 text-sm mt-2 inline-block">View All →</a>
            </div>
            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-gray-500">Total Events</h3>
                <p class="text-3xl font-bold">{{ $totalEvents }}</p>
                <a href="{{ route('admin.events.index') }}" class="text-blue-600 text-sm mt-2 inline-block">View All →</a>
            </div>

            <!-- Approving events created by students -->
            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-gray-500">Pending Event Approvals</h3>
                <p class="text-3xl font-bold">{{ $pendingEvents }}</p>
                <a href="{{ route('admin.events.pending') }}" class="text-blue-600 text-sm mt-2 inline-block">View Pending →</a>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-gray-500">Assign Lecturers</h3>
                <p class="text-3xl font-bold">Assign</p>
                <a href="{{ route('admin.assign') }}" class="text-blue-600 text-sm mt-2 inline-block">Assign →</a>
            </div>  
        </div>
    </div>
</body>
</html>