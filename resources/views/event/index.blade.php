@extends('layouts.app')

@section('content')

<div class="p-6 max-w-6xl mx-auto">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold" style="font-family: 'Times New Roman', Times, serif;">SCHOOL APPROVED EVENTS</h1>
            <p class="text-gray-500 mt-1">Browse and manage all school events</p>
        </div>

        <a href="{{ route('event.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            + Create Event
        </a>
    </div>

    {{-- ================= APPROVED EVENTS ================= --}}
    <div class="mb-10">

        <h2 class="text-xl font-bold mb-4 text-green-700">🟢 Approved Events</h2>

        @if($approvedEvents->count() > 0)

            <div class="grid md:grid-cols-2 gap-4">

                @foreach($approvedEvents as $event)
                    <div class="p-5 bg-white border rounded-xl shadow-sm">

                        <h3 class="text-lg font-semibold">
                            {{ $event->title }}
                        </h3>

                        <p class="text-gray-600 mt-2 line-clamp-2">
                            {{ $event->description }}
                        </p>

                        <div class="text-sm text-gray-500 mt-3">
                            📍 {{ $event->location ?? 'TBA' }} <br>
                            🕒 {{ \Carbon\Carbon::parse($event->start_datetime)->format('d M Y, H:i') }}
                        </div>

                    </div>
                @endforeach

            </div>

        @else
            <div class="p-6 bg-gray-50 border rounded-xl text-gray-500">
                No approved events available yet.
            </div>
        @endif

    </div>


</div>

@endsection