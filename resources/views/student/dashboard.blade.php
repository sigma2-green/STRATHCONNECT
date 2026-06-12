@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 p-6">

    <div class="max-w-5xl mx-auto">

        <h1 class="text-3xl font-bold text-center mb-8">
            Student Dashboard
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

           <!-- I want to introduce the chat form of whatsapp showing all groups acccesible to the student and the option to create a new group.These groups are based on course, school and year.   -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-gray-600 font-semibold mb-4">Your Groups</h2>
                <ul class="space-y-3">
                    @foreach($groups as $group)
                        <li class="flex items-center justify-between bg-gray-200 rounded-lg p-3">
                            <div>
                                <h3 class="text-gray-600 font-medium">{{ $group->name }}</h3>
                            </div>
                            <a href="" class="text-blue-500 hover:underline">View</a>
                        </li>
                    @endforeach
                </ul>

        </div>

    </div>
</div>
@endsection