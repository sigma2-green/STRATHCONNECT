@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50 py-12 px-8">
    <div class="max-w-6xl mx-auto pt-8">

        <div class="mb-16">

            <h1 class="text-4xl font-bold text-slate-800">
                👋 Welcome to StrathConnect
            </h1>

            <p class="text-slate-500 mt-2">
                Stay connected with announcements, events, coursework and your student community.
            </p>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- LEFT COLUMN -->
            <div class="space-y-6">

                <a href="{{ route('student.announcements') }}"
                   class="w-full h-28 flex items-center gap-4 rounded-2xl bg-blue-600 text-white px-6 shadow-lg hover:scale-105 hover:shadow-2xl transition duration-300">
                    <span class="text-3xl">📢</span>
                    <div>
                        <div class="font-bold text-lg">Announcements</div>
                        <div class="text-sm opacity-80">View latest news</div>
                    </div>
                </a>

                <a href="#"
                   class="w-full h-28 flex items-center gap-4 rounded-2xl bg-green-600 text-white px-6 shadow-lg hover:scale-105 hover:shadow-2xl transition duration-300">
                    <span class="text-3xl">📅</span>
                    <div>
                        <div class="font-bold text-lg">Events</div>
                        <div class="text-sm opacity-80">See upcoming events</div>
                    </div>
                </a>

                <a href="#"
                   class="w-full h-28 flex items-center gap-4 rounded-2xl bg-purple-600 text-white px-6 shadow-lg hover:scale-105 hover:shadow-2xl transition duration-300">
                    <span class="text-3xl">👥</span>
                    <div>
                        <div class="font-bold text-lg">Groups</div>
                        <div class="text-sm opacity-80">Join student groups</div>

<div class="h-screen flex overflow-hidden bg-slate-900 text-white">

    {{-- ================= SIDEBAR ================= --}}
    <aside class="w-72 flex flex-col h-full min-h-0 overflow-hidden">

        <div class="h-16 flex items-center justify-center border-b border-slate-800">
            <h1 class="text-xl font-bold text-blue-600">STRATHCONNECT</h1>
        </div>

        <div class="flex-1 min-h-0 overflow-y-auto">

            @foreach([
                'SCHOOL' => $schoolGroups,
                'COURSE' => $courseGroups,
                'YEAR' => $yearGroups,
                'CLASS' => $classGroups
            ] as $label => $groups)

                <div class="mb-4">
                    <p class="text-xs text-slate-500 px-2 mb-2">{{ $label }}</p>

                    <div class="space-y-1">
                        @forelse($groups as $group)
                            <a href="{{ route('student.dashboard', ['group' => $group->id]) }}"
                               class="block px-3 py-2 rounded-lg text-sm
                               {{ request('group') == $group->id
                                    ? 'bg-blue-600 text-white'
                                    : 'hover:bg-slate-800 text-slate-300' }}">
                                {{ $group->name }}
                            </a>
                        @empty
                            <p class="text-xs text-slate-600 px-3">No groups</p>
                        @endforelse
                    </div>
                </div>

            @endforeach

        </div>
    </aside>

    {{-- ================= MAIN ================= --}}
    <main class="flex-1 flex flex-col h-full min-h-0 overflow-hidden bg-slate-900">

    @if($selectedGroup)

        {{-- HEADER --}}
        <div class="h-16 flex items-center justify-between px-5 border-b border-slate-800 bg-slate-800 flex-shrink-0">
            <div>
                <h2 class="font-semibold text-lg">{{ $selectedGroup->name }}</h2>
                <p class="text-xs text-slate-400">{{ $posts->count() }} posts</p>
            </div>
        </div>

            <!-- RIGHT COLUMN -->
            <div class="space-y-6">

                <a href="#"
                   class="w-full h-28 flex items-center gap-4 rounded-2xl bg-orange-600 text-white px-6 shadow-lg hover:scale-105 hover:shadow-2xl transition duration-300">
                    <span class="text-3xl">📚</span>
                    <div>
                        <div class="font-bold text-lg">Courses</div>
                        <div class="text-sm opacity-80">View enrolled units</div>
                    </div>
                </a>

                <a href="#"
                   class="w-full h-28 flex items-center gap-4 rounded-2xl bg-red-600 text-white px-6 shadow-lg hover:scale-105 hover:shadow-2xl transition duration-300"
                    <span class="text-3xl">📝</span>
                    <div>
                        <div class="font-bold text-lg">Assignments</div>
                        <div class="text-sm opacity-80">Track coursework</div>
                    </div>
                </a>

                <a href="#"
                   class="w-full h-28 flex items-center gap-4 rounded-2xl bg-slate-700 text-white px-6 shadow-lg hover:scale-105 hover:shadow-2xl transition duration-300">
                    <span class="text-3xl">⚙️</span>
                    <div>
                        <div class="font-bold text-lg">Settings</div>
                        <div class="text-sm opacity-80">Manage profile</div>
        {{-- FEED --}}
    <div id="feedBox" class="flex-1 min-h-0 overflow-y-auto px-4 py-4 space-y-5 scroll-smooth">

    @php $prevUser = null; @endphp

    @forelse($posts->sortBy('created_at') as $post)


        @php
            $isMine =
                ($post->student_id && $post->student_id == Auth::guard('student')->id()) ||
                ($post->lecturer_id && $post->lecturer_id == Auth::guard('lecturer')->id());

            $sameUser = $prevUser === ($post->student_id ?? $post->lecturer_id);
            $prevUser = $post->student_id ?? $post->lecturer_id;

            $authorName =
                $post->student->username
                ?? $post->lecturer->name
                ?? 'Unknown User';
        @endphp

        {{-- DATE --}}
        @if($loop->first || $posts[$loop->index - 1]->created_at->format('Y-m-d') !== $post->created_at->format('Y-m-d'))
            <div class="flex justify-center">
                <span class="text-xs bg-slate-700 text-slate-300 px-3 py-1 rounded-full">
                    {{ $post->created_at->format('d M Y') }}
                </span>
            </div>
        @endif

        {{-- POST --}}
        <div class="flex {{ $isMine ? 'justify-end' : 'justify-start' }}">

            <div class="max-w-[70%]">

                @if(!$isMine && !$sameUser)
                    <div class="text-xs text-slate-400 mb-1 ml-1">
                        {{ $authorName }}
                    </div>
                @endif

                {{-- CLICKABLE BUBBLE (THIS IS KEY CHANGE) --}}
                <div
                    class="bg-slate-800 rounded-2xl px-4 py-3 break-words cursor-pointer hover:bg-slate-700 transition"
                    onclick="selectPost({{ $post->id }})"
                    id="post-{{ $post->id }}">

                    {{-- IMAGE --}}
                    @if($post->attachment && $post->attachment_type === 'image')
                        <img src="{{ Storage::url($post->attachment) }}"
                             class="w-16 h-16 rounded-full object-cover"
                             onclick="event.stopPropagation(); openImage(this.src)">
                    @endif

                    {{-- TEXT --}}
                    @if($post->content)
                        <div class="text-sm text-slate-100 leading-relaxed">
                            {{ $post->content }}
                        </div>
                    @endif

                    {{-- COMMENTS PREVIEW (NO INPUT HERE ANYMORE) --}}
                    @if($post->comments->count() > 0)
                        <div class="mt-3 border-t border-slate-700 pt-3 space-y-2">

                            @foreach($post->comments->take(2) as $comment)
                                <div class="text-xs text-slate-300">
                                    <span class="font-semibold text-slate-400">
                                        {{ $comment->student->username ?? $comment->lecturer->name ?? 'User' }}:
                                    </span>
                                    {{ $comment->content }}
                                </div>
                            @endforeach

                            <div id="more-comments-{{ $post->id }}" class="hidden space-y-2">
                                @foreach($post->comments->skip(2) as $comment)
                                    <div class="text-xs text-slate-300">
                                        <span class="font-semibold text-slate-400">
                                            {{ $comment->student->username ?? $comment->lecturer->name ?? 'User' }}:
                                        </span>
                                        {{ $comment->content }}
                                    </div>
                                @endforeach
                            </div>

                            @if($post->comments->count() > 2)
                                <button onclick="toggleComments(event, {{ $post->id }})"
                                        class="text-[11px] text-blue-400 hover:underline">
                                    View all comments ({{ $post->comments->count() }})
                                </button>
                            @endif

                        </div>
                    @endif

                    {{-- TIME --}}
                    <div class="text-[10px] text-slate-500 mt-2 text-right">
                        {{ $post->created_at->format('H:i') }}
                    </div>

                </div>
            </div>
        </div>

    @empty
        <div class="h-full flex items-center justify-center text-center text-slate-400">
            <div>
                <div class="text-6xl mb-3">💬</div>
                <p>No posts yet</p>
            </div>
        </div>
    @endforelse
</div>

{{-- WHATSAPP-STYLE COMMENT BAR (GLOBAL, NOT PER POST) --}}
<div id="commentBar"
     class="hidden flex-shrink-0 border-t border-slate-800 bg-slate-800 p-3">

    <form action="{{ route('comments.store') }}" method="POST"
          class="flex gap-2 items-center w-full" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="post_id" id="activePostId">

        <input type="text"
               name="content"
               id="commentInput"
               placeholder="Write a comment..."
               class="flex-1 bg-slate-900 border border-slate-700 rounded-full px-4 py-2 text-lg font-semibold text-gray-500 focus:ring-2 focus:ring-blue-500"
               required>

        <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-full text-lg font-semibold">
            Send
        </button>
    </form>
</div>
        {{-- INPUT --}}
        <div class="flex-shrink-0 border-t border-slate-800 bg-slate-800 p-4">

            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="group_id" value="{{ $selectedGroup->id }}">

                <div class="flex gap-3 items-center">

                    <input type="file" name="image" class="text-sm text-white">

                    <input type="text"
                           name="content"
                           placeholder="Type a message..."
                           class="flex-1 bg-slate-900 border border-slate-700 rounded-full px-4 py-3 text-sm text-white focus:ring-2 focus:ring-green-500">

                    <button type="submit"
                            class="w-11 h-11 rounded-full bg-green-600 hover:bg-green-700 flex items-center justify-center">
                        ➤
                    </button>

                </div>

            </form>

        </div>

    @else

        {{-- EMPTY --}}
        <div class="flex-1 flex items-center justify-center text-center">
            <div>
                <div class="text-7xl mb-4">💬</div>
                <h2 class="text-2xl font-bold">STUDENT DASHBOARD</h2>
                <p class="text-slate-400">Select a group to begin</p>
            </div>
        </div>

    @endif

    </main>
</div>

{{-- IMAGE MODAL --}}
<div id="imageModal"
     class="hidden fixed inset-0 bg-black/90 flex items-center justify-center z-50">
    <img id="modalImg" class="max-h-full max-w-full rounded-lg">
</div>

<script>
    let selectedPostId = null;

    function selectPost(postId) {
        selectedPostId = postId;

        document.getElementById('activePostId').value = postId;

        // show comment bar
        document.getElementById('commentBar').classList.remove('hidden');

        // focus input
        setTimeout(() => {
            document.getElementById('commentInput').focus();
        }, 100);

        // highlight selected post
        document.querySelectorAll('[id^="post-"]').forEach(el => {
            el.classList.remove('ring-2', 'ring-blue-500');
        });

        document.getElementById('post-' + postId)
            .classList.add('ring-2', 'ring-blue-500');
    }

    function toggleComments(e, postId) {
        e.stopPropagation();
        const el = document.getElementById('more-comments-' + postId);
        if (el) el.classList.toggle('hidden');
    }

    const feed = document.getElementById('feedBox');
    if (feed) feed.scrollTop = feed.scrollHeight;

    function openImage(src) {
        document.getElementById('modalImg').src = src;
        document.getElementById('imageModal').classList.remove('hidden');
    }

    document.getElementById('imageModal').onclick = () => {
        document.getElementById('imageModal').classList.add('hidden');
    };
</script>
@endsection