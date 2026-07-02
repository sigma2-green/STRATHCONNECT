<!DOCTYPE html>
<html>
<head>
    <title>Edit Announcement</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('images/strathConnect.png') }}">
</head>

<body class="bg-gray-100">

<div class="max-w-3xl mx-auto mt-10 bg-white shadow rounded-lg p-8">

    <h1 class="text-3xl font-bold mb-6">
        ✏️ Edit Announcement
    </h1>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-6">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST"
          action="{{ route('admin.announcements.update', $announcement->id) }}">

        @csrf
        @method('PUT')

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Title
            </label>

            <input
                type="text"
                name="title"
                value="{{ old('title', $announcement->title) }}"
                class="w-full border rounded-lg p-3"
                required>

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Message
            </label>

            <textarea
                name="message"
                rows="6"
                class="w-full border rounded-lg p-3"
                required>{{ old('message', $announcement->message) }}</textarea>

        </div>

        <div class="flex justify-between">

            <a href="{{ route('admin.announcements.index') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">

                Cancel

            </a>

            <button
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                Update Announcement

            </button>

        </div>

    </form>

</div>

</body>
</html>