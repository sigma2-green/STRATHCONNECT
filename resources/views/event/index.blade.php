@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto p-8">

    {{-- ================= HEADER ================= --}}
    <div class="flex flex-col md:flex-row justify-between md:items-center mb-8">

        <div>
            <h1 class="text-4xl font-bold text-slate-800">
                School Events
            </h1>

            <p class="text-slate-500 mt-2">
                Discover upcoming academic, social and community events.
            </p>
        </div>

        <div class="mt-5 md:mt-0">

            <a href="{{ route('event.create') }}"
               class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl shadow">

                <span class="text-xl">+</span>

                Create Event

            </a>

        </div>

    </div>

    {{-- ================= STATISTICS ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        <div class="bg-white rounded-2xl shadow p-6">

            <h2 class="text-3xl font-bold text-blue-600">

                {{ $approvedEvents->count() }}

            </h2>

            <p class="text-slate-500 mt-2">

                Approved Events

            </p>

        </div>

        <div class="bg-white rounded-2xl shadow p-6">

            <h2 class="text-3xl font-bold text-green-600">

                {{ $approvedEvents->where('start_datetime','>=',now())->count() }}

            </h2>

            <p class="text-slate-500 mt-2">

                Upcoming Events

            </p>

        </div>


    </div>
</br>

    {{-- ================= EVENTS ================= --}}

    @if($approvedEvents->count())

        <div class=" gap-8 rounded-3xl">

            @foreach($approvedEvents as $event)

                <div class="bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-xl transition">

                    {{-- Banner --}}
                    @if($event->banner)

                        <img
                            src="{{ Storage::url($event->banner) }}"
                            class="w-full h-60 object-cover">

                    @else

                        <div class="h-60 bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center">

                            <div class="text-white text-6xl">
                                📅
                            </div>

                        </div>

                    @endif

                    <div class="p-6">

                        {{-- Title --}}
                        <div class="flex justify-between items-start">

                            <h2 class="text-2xl font-bold text-slate-800">

                                {{ $event->title }}

                            </h2>

                            <span class="bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">

                                Approved

                            </span>

                        </div>

                        {{-- Creator --}}
                        <p class="text-sm text-slate-500 mt-2">

                            Created by

                            <span class="font-semibold">

                                {{ $event->creatorStudent?->username
                                    ?? $event->creatorLecturer?->name
                                    ?? 'Unknown User' }}

                            </span>

                        </p>

                        {{-- Description --}}
                        <p class="text-slate-600 mt-5 leading-relaxed">

                            {{ $event->description }}

                        </p>

                        {{-- Divider --}}
                        <hr class="my-5">

                        {{-- Information --}}
                        <div class="space-y-3 text-sm">

                            <div>

                                📍
                                <span class="font-medium">
                                    {{ $event->location }}
                                </span>

                            </div>

                            <div>

                                📅 Starts:

                                <strong>

                                    {{ $event->start_datetime->format('d M Y • H:i') }}

                                </strong>

                            </div>

                            <div>

                                🏁 Ends:

                                <strong>

                                    {{ $event->end_datetime->format('d M Y • H:i') }}

                                </strong>

                            </div>

                            <div>

                                👥 Capacity:

                                <strong>

                                    {{ $event->capacity ?? 'Unlimited' }}

                                </strong>

                            </div>

                            <div>

                                🌍 Visibility:

                                <span class="capitalize font-semibold">

                                    {{ $event->visibility }}

                                </span>

                            </div>

                        </div>

                        {{-- Buttons --}}
                        <div class="mt-8 flex gap-3">

                            

                            <button
                                class="flex-1 bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-semibold">

                                Attend

                            </button>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="bg-white rounded-3xl shadow p-6 text-center">

            <h2 class="text-2xl font-bold text-slate-800">

                No Approved Events

            </h2>
        </div>


    @endif

</div>

@endsection