<!DOCTYPE html>
<html>
<head>
    <title>New Event</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-3xl mx-auto mt-10 bg-white shadow rounded-lg p-8">

    <h1 class="text-3xl font-bold mb-6">
        📅 Create Event
    </h1>

    <form method="POST" action="{{ route('admin.events.store') }}">
        @csrf

        <div class="mb-5">
            <label class="block font-semibold mb-2">
                Title
            </label>

            <input
                type="text"
                name="title"
                class="w-full border rounded-lg p-3"
                placeholder="Enter event title"
                required>
        </div>

        <div class="mb-5">
            <label class="block font-semibold mb-2">
                Description
            </label>

            <textarea
                rows="6"
                name="description"
                class="w-full border rounded-lg p-3"
                placeholder="Write your event description..."
                required></textarea>

            <label class="block font-semibold mt-5 mb-2">
                Venue
            </label>

            <input
                type="text"
                name="venue"
                class="w-full border rounded-lg p-3"
                required>

            <label class="block font-semibold mt-5 mb-2">
                Event Date
            </label>

            <input
                type="date"
                name="event_date"
                class="w-full border rounded-lg p-3"
                required>

        </div>

        <button
            class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">

            Post Event

        </button>

    </form>

</div>

</body>
</html>