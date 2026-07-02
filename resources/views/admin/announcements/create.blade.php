<!DOCTYPE html>
<html>
<head>
    <title>New Announcement</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('images/strathConnect.png') }}">
</head>

<body class="bg-gray-100">

<div class="max-w-3xl mx-auto mt-10 bg-white shadow rounded-lg p-8">

    <h1 class="text-3xl font-bold mb-6">
        📢 Create Announcement
    </h1>

    <form method="POST" action="{{ route('admin.announcements.store') }}">
        @csrf

        <div class="mb-5">
            <label class="block font-semibold mb-2">
                Title
            </label>

            <input
                type="text"
                name="title"
                class="w-full border rounded-lg p-3"
                placeholder="Enter announcement title"
                required>
        </div>

        <div class="mb-5">
            <label class="block font-semibold mb-2">
                Message
            </label>

            <textarea
                rows="6"
                name="message"
                class="w-full border rounded-lg p-3"
                placeholder="Write your announcement..."
                required></textarea>
        </div>

        <button
            class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">

            Post Announcement

        </button>

    </form>

</div>

</body>
</html>