<!-- Show all admins-->
<!DOCTYPE html>
<html>
<head>
    <title>Events - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex space-x-6">
                <h1 class="text-xl font-bold">Admin Panel</h1>
                <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800">Dashboard</a>
                <a href="{{ route('admin.events.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Events</a>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf   
                <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
            </form>
        </div>
    </nav>
    <div class="max-w-7xl mx-auto p-4"> 
        <h2 class="text-2xl font-bold mb-6">All Events</h2>
        
        @if($events->isEmpty())
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
                No events found.
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
                            <th class="px-6 py-3 text-left">Status</th>

                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($events as $event)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $event->id }}</td>
                            <td class="px-6 py-4">{{ $event->title }}</td>
                            <td class="px-6 py-4">{{ $event->location }}</td>
                            <td class="px-6 py-4">{{ $event->start_date }}</td>
                            <td class="px-6 py-4">{{ $event->end_date }}</td>
                            <td class="px-6 py-4">{{ $event->created_by_student_id }}</td>
                            <td class="px-6 py-4">{{ $event->created_at }}</td>
                            <td class="px-6 py-4">{{ ucfirst($event->status) }}</td>
                            <td class="px-6 py-4">
                                <form method="POST" action="{{ route('admin.events.delete', $event) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                </form>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
</body>
</html>