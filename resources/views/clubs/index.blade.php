@extends('layouts.app')

@section('content')

<div class="p-6 space-y-8">


{{-- HEADER --}}
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
            Clubs & Societies
        </h1>

        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
            Join existing clubs, discover new communities, or start one of your own.
        </p>
    </div>

    @auth('student')
<a href="{{ route('clubs.create') }}"
   class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
    + Create Club
</a>
@endauth
</div>

{{-- MY CLUBS --}}
<section>
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            My Clubs
        </h2>
    </div>

    @if($myClubs->isEmpty())
        <div class="bg-white dark:bg-slate-800 border dark:border-slate-700 rounded-xl p-8 text-center">
            <p class="text-gray-500 dark:text-gray-400">
                You haven't joined any clubs yet.
            </p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">

            @foreach($myClubs as $club)
                <div class="bg-white dark:bg-slate-800 border dark:border-slate-700 rounded-xl p-5 shadow-sm">

                    <div class="flex items-center gap-3 mb-4">

                        @if($club->logo)
                            <img src="{{ asset('storage/' . $club->logo) }}"
                                 alt="{{ $club->name }}"
                                 class="w-10 h-10 rounded-full object-cover">
                        @else
                            <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-slate-700 flex items-center justify-center font-bold text-blue-700 dark:text-blue-300">
                                {{ strtoupper(substr($club->name, 0, 1)) }}
                            </div>
                        @endif

                        <div>
                            <h3 class="font-bold text-black dark:text-white">
                                {{ $club->name }}
                            </h3>

                            <p class="text-sm text-gray-500">
                                {{ $club->category ?? 'Club & Society' }}
                            </p>
                        </div>
                    </div>

                    <div class="space-y-1 text-sm text-gray-500">
                        <p>
                            {{ $club->members_count ?? $club->members()->count() }}
                            members
                        </p>
                    </div>

                    <div class="mt-4">
                        <a href="#"
                           class="inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm">
                            View Club
                        </a>
                    </div>

                </div>
            @endforeach

        </div>
    @endif
</section>

{{-- DISCOVER CLUBS --}}
<section>
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            Discover Clubs
        </h2>
    </div>

    @if($discoverClubs->isEmpty())
        <div class="bg-white dark:bg-slate-800 border dark:border-slate-700 rounded-xl p-8 text-center">
            <p class="text-gray-500 dark:text-gray-400">
                No clubs available at the moment.
            </p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">

            @foreach($discoverClubs as $club)
                <div class="bg-gray-100 dark:bg-slate-800 border dark:border-slate-700 rounded-xl p-5 shadow-sm">

                    <div class="flex items-center gap-3 mb-4">

                        @if($club->logo)
                            <img src="{{ asset('storage/' . $club->logo) }}"
                                 alt="{{ $club->name }}"
                                 class="w-10 h-10 rounded-full object-cover">
                        @else
                            <div class="w-10 h-10 rounded-full bg-green-100 dark:bg-slate-700 flex items-center justify-center font-bold text-green-700 dark:text-green-300">
                                {{ strtoupper(substr($club->name, 0, 6)) }}
                            </div>
                        @endif

                        <div>
                            <h3 class="font-bold text-gray-900 dark:text-black">
                                {{ $club->name }}
                            </h3>

                            <p class="text-sm text-gray-500">
                                {{ $club->category ?? 'Club & Society' }}
                            </p>
                        </div>
                    </div>

                    <div class="space-y-1 text-sm text-gray-500">
                        <p>
                            {{ $club->members_count ?? $club->members()->count() }}
                            members
                        </p>
                    </div>

                    <div class="mt-4 flex gap-2">

                        <form method="POST"
                              action="{{ route('clubs.join', $club->id) }}">
                            @csrf

                           @auth('student')
<form method="POST" action="{{ route('clubs.join', $club->id) }}">
    @csrf
    <button class="mt-3 bg-green-600 text-white px-3 py-1 rounded">
        Join
    </button>
</form>
@endauth
                        </form>

                        <a href="#"
                           class="px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg text-sm">
                            View
                        </a>

                    </div>

                </div>
            @endforeach

        </div>
    @endif
</section>


</div>
@endsection
