@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-8">

        <h1 class="text-3xl font-bold mb-4">
            {{ $club->name }}
        </h1>

        <p class="text-gray-600 dark:text-gray-300 mb-6">
            {{ $club->description }}
        </p>

        <div class="grid grid-cols-2 gap-6">

            <div>
                <h2 class="font-semibold">Category</h2>
                <p>{{ $club->category }}</p>
            </div>

            <div>
                <h2 class="font-semibold">Members</h2>
                <p>{{ $club->members()->count() }}</p>
            </div>

        </div>

        <div class="mt-8">
            <a href="{{ url()->previous() }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                ← Back
            </a>
        </div>

    </div>

</div>

@endsection
