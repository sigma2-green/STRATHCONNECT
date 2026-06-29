<!DOCTYPE html>
<html>
<head>
    <title>Announcements - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Navigation -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <div class="flex items-center gap-6">

                <h1 class="text-xl font-bold text-gray-800">
                    Admin Panel
                </h1>

                <a href="{{ route('admin.dashboard') }}"
                   class="text-blue-600 hover:text-blue-800">
                    Dashboard
                </a>

                <a href="{{ route('admin.students') }}"
                   class="text-blue-600 hover:text-blue-800">
                    Students
                </a>

                <a href="{{ route('admin.announcements.index') }}"
                   class="font-semibold text-blue-700">
                    Announcements
                </a>

            </div>

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf

                <button class="text-red-600 hover:text-red-800">
                    Logout
                </button>

            </form>

        </div>
    </nav>

    <div class="max-w-6xl mx-auto mt-10">

        <div class="flex justify-between items-center mb-8">

            <div>

                <h1 class="text-3xl font-bold">
                    📅 Events
                </h1>

                <p class="text-gray-500 mt-2">
                    Manage upcoming campus events.
                </p>

            </div>

            <a href="{{ route('admin.events.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg">

                + New Event

            </a>

        </div>

        @if(session('success'))

            <div class="bg-green-100 border border-green-400 text-green-700 p-4 rounded mb-6">

                {{ session('success') }}

            </div>

        @endif
        @if($events->count() == 0)

    <div class="bg-yellow-100 border border-yellow-400 p-4 rounded">
        No events have been posted yet.
    </div>

@else

    @foreach($events as $event)

        <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6 mb-6">

            <div class="flex justify-between items-start">

                <div>

                    <h2 class="text-2xl font-bold text-gray-800">
                        {{ $event->title }}
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Posted by <strong>{{ $event->posted_by }}</strong>
                    </p>

                </div>

                <div class="text-sm text-gray-400">
                    {{ $event->created_at->format('d M Y') }}
                </div>

            </div>

            <hr class="my-4">

            <p class="text-gray-700 leading-7">
                {{ $event->description }}
            </p>

            <p class="text-sm text-slate-500 mt-3">
                📍 {{ $event->venue }}
            </p>

            <p class="text-sm text-slate-500">
                📅 {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
            </p>
            
            <div class="flex gap-3 mt-6">

                <a href="{{ route('admin.events.edit', $event->id) }}"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">

                    Edit

                </a>

                <form action="{{ route('admin.events.destroy', $event->id) }}"
                    method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this event?');">

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">

                        Delete

                    </button>

                </form>

            </div>

        </div>

    @endforeach

@endif

</div>

</body>
</html>