<!-- Show all admins-->
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - StrathConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">  
    <nav class="bg-white shadow p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex space-x-6">
                <h1 class="text-xl font-bold">Admin Panel</h1>
                <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Dashboard</a>
                <a href="{{ route('admin.index') }}" class="text-blue-600 hover:text-blue-800">Admins</a>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
            </form>
        </div>
    </nav>
    <div class="max-w-7xl mx-auto p-4">
       @if($admins->isEmpty())
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
                No admins found.
            </div>
        @else
            <div class="bg-white rounded shadow overflow-hidden">
                <table class="min-w-full">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left">name</th>
                            <th class="px-6 py-3 text-left">email</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($admins as $admin)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $admin->name }}</td>
                            <td class="px-6 py-4">{{ $admin->email }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif


    </div>      
    
