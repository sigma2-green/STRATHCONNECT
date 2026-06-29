<!DOCTYPE html>
<html>
<head>
    <title>Students - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex space-x-6">
                <h1 class="text-xl font-bold">Admin Panel</h1>
                <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800">Dashboard</a>
                <a href="{{ route('admin.students') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Students</a>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
            </form>
        </div>
    </nav>
    
    <div class="max-w-7xl mx-auto p-6">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        
        <h2 class="text-2xl font-bold mb-6">All Students</h2>
        
        @if($students->isEmpty())
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
                No students found.
            </div>
        @else
            <div class="bg-white rounded shadow overflow-hidden">
                <table class="min-w-full">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left">ID</th>
                            <th class="px-6 py-3 text-left">Name</th>
                            <th class="px-6 py-3 text-left">Email</th>
                            <th class="px-6 py-3 text-left">Student Number</th>
                            <th class="px-6 py-3 text-left">School</th>
                            <th class="px-6 py-3 text-left">Course</th>
                            <th class="px-6 py-3 text-left">Group</th>
                            <th class="px-6 py-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($students as $student)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $student->id }}</td>
                            <td class="px-6 py-4">{{ $student->username ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ $student->email }}</td>
                            <td class="px-6 py-4">{{ $student->student_number ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ $student->school ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ $student->course ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ $student->group ?? 'N/A' }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">

                                <a href="{{ route('admin.students.edit', $student->id) }}"
                                     class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">
                                     Edit
                                </a>

                                <form action="{{ route('admin.students.destroy', $student->id) }}"
                                        method="POST"
                                        style="display:inline;">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this student?')"
                                            class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700">
                                         Delete
                                    </button>

                                </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</body>
</html>