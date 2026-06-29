@if(Auth::guard('lecturer')->check())
    @extends('layouts.ui')
@else
    @extends('layouts.app')
@endif

@section('content')

<div class=" rounded-3xl bg-slate-100 py-10">

    <div class="  rounded-3xl bg-slate-50 shadow-lg overflow-hidden">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">

            <div>
                <h1 class="text-4xl font-bold text-slate-800">
                    Create New Event
                </h1>

                <p class="text-slate-500 mt-2">
                    Organize academic, social and community events for Strathmore students.
                </p>
            </div>

            <a href="{{ route('event.index') }}"
               class="px-5 py-3 bg-gray-800 text-white rounded-xl shadow hover:bg-gray-700  transition">
                ← Back to Events<!--should be black for visibility-->
            </a>

        </div>

        {{-- Validation Errors --}}
        @if ($errors->any())

            <div class="mb-6 bg-red-100 border border-red-300 rounded-xl p-4">

                <h3 class="font-semibold text-red-700 mb-2">
                    Please fix the following errors:
                </h3>

                <ul class="list-disc ml-6 text-red-600">

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif

        <form method="POST"action="{{ route('event.store') }}"enctype="multipart/form-data"class="space-y-8">

            @csrf

            <div class="bg-gray-100 rounded-3xl shadow-lg overflow-hidden">

                {{-- Card Header --}}
                <div class="bg-blue-600 px-8 py-6">

                    <h2 class="text-2xl font-bold text-white">
                        Event Information
                    </h2>

                    <p class="text-blue-100 mt-1">
                        Complete the details below before submitting your event.
                    </p>

                </div>

                <div class="p-8 space-y-8">

                    {{-- Event Title --}}
                    <div>

                        <label class="block font-semibold text-slate-700 mb-2">
                            Event Title
                        </label>

                        <input
                            type="text"
                            name="title"
                            value="{{ old('title') }}"
                            placeholder="e.g. Cultural Day 2026"

                            class="w-full rounded-xl border border-gray-300
                                   px-4 py-3
                                   focus:ring-2
                                   focus:ring-blue-500
                                   focus:border-blue-500
                                   transition"

                            required>

                    </div>

                    {{-- Description --}}
                    <div>

                        <label class="block font-semibold text-slate-700 mb-2">
                            Description
                        </label>

                        <textarea

                            name="description"

                            rows="5"

                            placeholder="Describe the purpose of your event..."

                            class="w-full rounded-xl border border-gray-300
                                   px-4 py-3
                                   focus:ring-2
                                   focus:ring-blue-500
                                   focus:border-blue-500">{{ old('description') }}</textarea>

                    </div>

                    <div>

    <label class="block font-semibold text-slate-700 mb-2">
        Event Banner (Optional)
    </label>

    <input
        type="file"
        name="banner"
        accept="image/*"
        class="w-full rounded-xl border border-gray-300 px-4 py-3">

    <p class="text-sm text-slate-500 mt-2">
        Upload a poster or banner for the event.
    </p>
  <img id="bannerPreview"
     class="hidden mt-4 rounded-xl max-h-60 w-full object-cover">
</div>

                    {{-- Two Columns --}}
                    <div class="grid md:grid-cols-2 gap-6">

                        {{-- Location --}}
                        <div>

                            <label class="block font-semibold text-slate-700 mb-2">
                                Venue
                            </label>

                            <input

                                type="text"

                                name="location"

                                value="{{ old('location') }}"

                                placeholder="Main Auditorium"

                                class="w-full rounded-xl border border-gray-300
                                       px-4 py-3
                                       focus:ring-2
                                       focus:ring-blue-500">

                        </div>

                        <div>

    <label class="block font-semibold text-slate-700 mb-2">
        Maximum Attendees
    </label>

    <input
        type="number"
        name="capacity"
        min="1"
        value="{{ old('capacity') }}"
        placeholder="Leave empty for unlimited"

        class="w-full rounded-xl border border-gray-300
               px-4 py-3
               focus:ring-2
               focus:ring-blue-500">

</div>

            <div>

    <label class="block font-semibold text-slate-700 mb-2">
        Visibility
    </label>

    <select
        name="visibility"
        class="w-full rounded-xl border border-gray-300
               px-4 py-3
               focus:ring-2
               focus:ring-blue-500">

        <option value="public">Public</option>
        <option value="school">School Only</option>
        <option value="course">Course Only</option>
        <option value="group">Specific Group</option>
        <option value="club">Specific Club</option>

    </select>

</div>



                        <div>

                            <label class="block font-semibold text-slate-700 mb-2">
                                Event Status
                            </label>

                            <div class="rounded-xl bg-yellow-100 border border-yellow-300 p-4">

                                <div class="font-semibold text-yellow-700">

                                    🟡 Pending Approval

                                </div>

                                <p class="text-sm text-yellow-700 mt-1">

                                    Your event will be reviewed by a lecturer before it becomes visible to everyone.

                                </p>

                            </div>

                        </div>

                    </div>

                    {{-- Date Section --}}
                    <div class="border-t pt-8">

                        <h3 class="text-xl font-bold text-slate-700 mb-5">

                            Event Schedule

                        </h3>

                        <div class="grid md:grid-cols-2 gap-6">

                            <div>

                                <label class="block font-semibold mb-2">

                                    Start Date & Time

                                </label>

                                <input

                                    type="datetime-local"

                                    name="start_datetime"

                                    value="{{ old('start_datetime') }}"

                                    class="w-full rounded-xl border border-gray-300
                                           px-4 py-3
                                           focus:ring-2
                                           focus:ring-blue-500"

                                    required>

                            </div>

                            <div>

                                <label class="block font-semibold mb-2">

                                    End Date & Time

                                </label>

                                <input

                                    type="datetime-local"

                                    name="end_datetime"

                                    value="{{ old('end_datetime') }}"

                                    class="w-full rounded-xl border border-gray-300
                                           px-4 py-3
                                           focus:ring-2
                                           focus:ring-blue-500"

                                    required>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="border-t pt-8">

    <h3 class="text-xl font-bold text-slate-700 mb-4">
        Submission Information
    </h3>

    <div class="bg-blue-50 border border-blue-200 rounded-xl p-5">

        <ul class="space-y-2 text-slate-700">

            <li>✓ Your event will be reviewed before publication.</li>

            <li>✓ Only approved events appear to students.</li>

            <li>✓ You can edit the event before approval.</li>

            <li>✓ Event organizers are notified once approved.</li>

        </ul>

    </div>

</div>

                {{-- Footer --}}
                <div class="bg-slate-50 border-t px-8 py-6 flex justify-end">

                    <button

                        type="submit"

                        class="px-8 py-3 bg-blue-600 text-white
                               rounded-xl
                               hover:bg-blue-700
                               transition
                               font-semibold
                               shadow">

                        📅 Submit Event for Approval

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>
<script>
document.querySelector('input[name="banner"]').addEventListener('change', function(e){

    const file = e.target.files[0];

    if(!file) return;

    const preview = document.getElementById('bannerPreview');

    preview.src = URL.createObjectURL(file);

    preview.classList.remove('hidden');

});
</script>

@endsection