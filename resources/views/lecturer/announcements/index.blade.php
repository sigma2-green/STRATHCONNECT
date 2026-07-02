@extends('layouts.ui')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 p-6">

    <div class="max-w-5xl mx-auto">

        <div class="flex justify-between items-center mb-8">

            <div>
                <h1 class="text-3xl font-bold">
                    📢 Campus Announcements
                </h1>

                <p class="text-gray-600 mt-2">
                    Stay updated with the latest announcements from the administration.
                </p>
            </div>

            <a href="{{ route('lecturer.dashboard') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                ← Back to Dashboard
            </a>

        </div>

        @if($announcements->count() == 0)

            <div class="bg-yellow-100 border border-yellow-400 rounded-lg p-5">
                No announcements available.
            </div>

        @else

            @foreach($announcements as $announcement)

                <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6 mb-6">

                    <div class="flex justify-between">

                        <div>

                            <h2 class="text-2xl font-bold">
                                {{ $announcement->title }}
                            </h2>

                            <p class="text-sm text-gray-500 mt-1">
                                Posted by {{ $announcement->posted_by }}
                            </p>

                        </div>

                        <div class="text-sm text-gray-400">
                            {{ $announcement->created_at->format('d M Y') }}
                        </div>

                    </div>

                    <hr class="my-4">

                    <p class="text-gray-700 leading-7">
                        {{ $announcement->message }}
                    </p>

                </div>

            @endforeach

        @endif

    </div>

</div>

@endsection




