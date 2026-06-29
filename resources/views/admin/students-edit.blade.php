<!DOCTYPE html>
<html>
<head>
    <title>Edit Student - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex space-x-6">
                <h1 class="text-xl font-bold">Admin Panel</h1>
                <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800">Dashboard</a>
                <a href="{{ route('admin.students') }}" class="text-blue-600 hover:text-blue-800">Students</a>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
            </form>
        </div>
    </nav>
    
    <div class="max-w-3xl mx-auto p-6">
        <div class="bg-white rounded shadow p-6">
            <h2 class="text-2xl font-bold mb-6">Edit Student</h2>

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.students.update', $student->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Username</label>
                    <input type="text" name="username" value="{{ old('username', $student->username) }}" 
                           class="w-full p-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $student->email) }}" 
                           class="w-full p-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Student Number</label>
                    <input type="text" name="student_number" value="{{ old('student_number', $student->student_number) }}" 
                           class="w-full p-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">School</label>
                    <input type="text" name="school" value="{{ old('school', $student->school) }}" 
                           class="w-full p-2 border rounded">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Course</label>
                    <input type="text" name="course" value="{{ old('course', $student->course) }}" 
                           class="w-full p-2 border rounded">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Group</label>
                    <input type="text" name="group" value="{{ old('group', $student->group) }}" 
                           class="w-full p-2 border rounded">
                </div>

                <div class="flex justify-between">
                    <a href="{{ route('admin.students') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update Student</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>