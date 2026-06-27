@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto p-6 space-y-10">

    {{-- ================= ACCOUNT SETTINGS ================= --}}
    
        @include('profile.partials.update-profile-information-form')

        @include('profile.partials.update-password-form')
    
        @include('profile.partials.delete-user-form')

    {{-- ================= MY EVENTS ================= --}}
    <div class="bg-white p-6 rounded-xl shadow-sm">

        <h2 class="text-2xl font-bold mb-6 text-gray-800">
            My Events
        </h2>

        @if($myEvents->count())

            <div class="grid md:grid-cols-2 gap-4">

                @foreach($myEvents as $event)
                    <div class="p-5 border rounded-xl shadow-sm">

                        <div class="flex justify-between items-start">

                            <h3 class="text-lg font-semibold text-gray-800">
                                {{ $event->title }}
                            </h3>

                            {{-- STATUS BADGE --}}
                            @if($event->status === 'approved')
                                <span class="text-xs px-3 py-1 rounded-full bg-green-100 text-green-700">
                                    Approved
                                </span>
                            @else
                                <span class="text-xs px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">
                                    Pending
                                </span>
                            @endif

                        </div>

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

            <div class="text-center py-10 bg-gray-50 border rounded-xl">

                <p class="text-gray-500 mb-3">
                    You have not created any events yet.
                </p>

                <a href="{{ route('event.create') }}"
                   class="bg-blue-600 text-white px-5 py-2 rounded-lg">
                    Create Event
                </a>

            </div>

        @endif

    </div>

</div>

@endsection
