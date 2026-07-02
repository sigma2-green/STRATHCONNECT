<!DOCTYPE html>
<html>
<head>  
    <title>Pending Events - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('images/strathConnect.png') }}">
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex space-x-6">
                <h1 class="text-xl font-bold">Admin Panel</h1>
                <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800">Dashboard</a>
                <a href="{{ route('admin.events.pending') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Pending Events</a>
            </div> 
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
            </form>
        </div>
    </nav>
    <div class="max-w-7xl mx-auto p-4">
        <h2 class="text-2xl font-bold mb-6">Pending Events</h2>
        @if($pendingEvents->isEmpty())
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
                No pending events found.
            </div>
        @else 
            <div class="bg-white rounded shadow overflow-hidden">
                <table class="min-w-full">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left">ID</th>
                            <th class="px-6 py-3 text-left">Title</th>
                            <th class="px-6 py-3 text-left">Location</th>
                            <th class="px-6 py-3 text-left">Start Date</th>
                            <th class="px-6 py-3 text-left">End Date</th>                        
                            <th class="px-6 py-3 text-left">Created By</th>
                            <th class="px-6 py-3 text-left">Created At</th>
                            <th class="px-6 py-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($pendingEvents as $event)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $event->id }}</td>
                            <td class="px-6 py-4">{{ $event->title }}</td>
                            <td class="px-6 py-4">{{ $event->location }}</td>
                            <td class="px-6 py-4">{{ $event->start_date }}</td>
                            <td class="px-6 py-4">{{ $event->end_date }}</td>
                            <td class="px-6 py-4">{{ $event->creatorStudent?->username ?? $event->creatorLecturer?->name ?? 'Unknown User' }}</td>
                            <td class="px-6 py-4">{{ $event->created_at }}</td>
                            <td class="px-6 py-4 space-x-2">
                                <!-- Approve Button -->
                                <form method="POST" action="{{ route('admin.events.approve', $event) }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">Approve</button>
                                </form>

                                <!-- Reject Button -->
                                <form method="POST" action="{{ route('admin.events.reject', $event) }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Reject</button>
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