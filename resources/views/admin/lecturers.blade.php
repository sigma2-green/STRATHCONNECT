<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - StrathConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('images/strathConnect.png') }}">
</head>
<body class="bg-gray-100">  
    <nav class="bg-white shadow p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex space-x-6">
                <h1 class="text-xl font-bold">Admin Panel</h1>
                <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Dashboard</a>
                <a href="{{ route('admin.lecturers') }}" class="text-blue-600 hover:text-blue-800">Lecturers</a>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
            </form>
        </div>
    </nav>
    <div class="max-w-7xl mx-auto p-4">
       @if($lecturers->isEmpty())
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
                No lecturers found.
            </div>
        @else
            <div class="bg-white rounded shadow overflow-hidden">
                <table class="min-w-full">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left">ID</th>
                            <th class="px-6 py-3 text-left">Name</th>
                            <th class="px-6 py-3 text-left">Email</th>
                            <th class="px-6 py-3 text-left">School</th>
                            <th class="px-6 py-3 text-left">Course</th>
                            <th class="px-6 py-3 text-left">Phone</th>
                            <th class="px-6 py-3 text-left">Staff Number</th>
                            <th class="px-6 py-3 text-left">Office Number</th>
                
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($lecturers as $lecturer)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $lecturer->id }}</td>
                            <td class="px-6 py-4">{{ $lecturer->name }}</td>
                            <td class="px-6 py-4">{{ $lecturer->email }}</td>
                            <td class="px-6 py-4">{{ $lecturer->school }}</td>
                            <td class="px-6 py-4">{{ $lecturer->course }}</td>
                            <td class="px-6 py-4">{{ $lecturer->phone }}</td>
                            <td class="px-6 py-4">{{ $lecturer->staff_number }}</td>
                            <td class="px-6 py-4">{{ $lecturer->office }}</td>
                        
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif  
    </div>  
</body>
</html>
