@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
            Create a New Club
        </h1>

        <p class="mt-2 text-gray-600 dark:text-gray-400">
            Submit a new club or society proposal. Once approved, students can join and participate.
        </p>
    </div>

    @if ($errors->any())
        <div class="mb-6 rounded-lg border border-red-300 bg-red-50 p-4">
            <h3 class="font-semibold text-red-700">
                Please fix the following errors:
            </h3>

            <ul class="mt-2 list-disc list-inside text-red-600 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
          action="{{ route('clubs.store') }}"
          enctype="multipart/form-data"
          class="space-y-6">

        @csrf

        <!-- Club Name -->
        <div>
            <label class="block mb-2 font-medium text-gray-700 dark:text-gray-300">
                Club Name
            </label>

            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   required
                   class="w-full rounded-lg border-gray-300 text-black">
        </div>

        <!-- Category -->
        <div>
            <label class="block mb-2 font-medium text-gray-700 dark:text-gray-300">
                Category
            </label>

            <select name="category"
                    required
                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 :text-black">

                <option value="">Select Category</option>

                <option value="Religious">Religious</option>
                <option value="Academic">Academic</option>
                <option value="Technology">Technology</option>
                <option value="Business">Business</option>
                <option value="Sports">Sports</option>
                <option value="Arts">Arts</option>
                <option value="Community Service">Community Service</option>
                <option value="Culture">Culture</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <!-- Description -->
        <div>
            <label class="block mb-2 font-medium text-gray-700 dark:text-gray-300">
                Description (Optional)
            </label>

            <textarea name="description"
                      rows="5"
                      class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-slate-800 dark:text-white"
                      placeholder="Briefly describe the club...">{{ old('description') }}</textarea>
        </div>

        <!-- Logo -->
        <div>
            <label class="block mb-2 font-medium text-gray-700 dark:text-gray-300">
                Club Logo (Optional)
            </label>

            <input type="file"
                   name="logo"
                   accept="image/*"
                   class="block w-full">
        </div>

        <!-- Banner -->
        <div>
            <label class="block mb-2 font-medium text-gray-700 dark:text-gray-300">
                Club Banner (Optional)
            </label>

            <input type="file"
                   name="banner"
                   accept="image/*"
                   class="block w-full">
        </div>

        <div class="flex gap-3">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                Create Club
            </button>

            <a href="{{ route('clubs.index') }}"
               class="bg-gray-200 hover:bg-gray-300 px-6 py-2 rounded-lg">
                Cancel
            </a>
        </div>

    </form>

</div>
@endsection