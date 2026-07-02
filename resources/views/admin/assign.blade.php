<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - StrathConnect</title>
    <script src="https://cdn.tailwindcss.com"></script> 
    <link rel="icon" type="image/png" href="{{ asset('images/strathConnect.png') }}">    
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex space-x-6">
                <h1 class="text-xl font-bold">Admin Panel</h1>
                <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Dashboard</a>
                <a href="{{ route('admin.assign') }}" class="text-blue-600 hover:text-blue-800">Lec Assignments</a>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
            </form> 
        </div>
    </nav>
    <div class="max-w-7xl mx-auto p-6">
        <h2 class="text-2xl font-bold mb-6">Lecturer Assignments</h2>   
        <!--Assigning lecturers to the classes they teach -->
    </div>
        
