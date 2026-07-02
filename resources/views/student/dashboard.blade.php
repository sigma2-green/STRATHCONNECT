@extends('layouts.app')

@section('content')
<div class="min-h-screen rounded-lg bg-gray-100 dark:bg-slate-900 py-12 px-8">


<div class="h-screen flex overflow-hidden bg-gray-100 dark:bg-slate-900 text-gray-900 dark:text-white rounded-lg transition-colors duration-300">

    {{-- ================= SIDEBAR ================= --}}
    <aside class="w-72 flex flex-col h-full min-h-0 overflow-hidden bg-white dark:bg-slate-900 border-r border-gray-200 dark:border-slate-700">

        <div class="h-16 flex items-center justify-center border-b border-slate-800">
            <h1 class="h-16 flex items-center justify-center border-b border-gray-200 dark:border-slate-700">STRATHCONNECT</h1>
        </div>
        <div class="flex-1 min-h-0 overflow-y-auto px-4 py-4 space-y-5 scroll-smooth">
        <a href="{{ route('student.announcements') }}"
                   class="w-full h-28 flex items-center gap-4 rounded-2xl bg-blue-600 text-white px-6 shadow-lg hover:scale-105 hover:shadow-2xl transition duration-300">
                    <span class="text-3xl">📢</span>
                    <div>
                        <div class="font-bold text-lg">Announcements</div>
                        <div class="text-sm opacity-80">View latest news</div>
                    </div>
                </a>
        
    </br>
        

        
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
                                    : 'hover:bg-gray-100 dark:hover:bg-slate-800 text-gray-700 dark:text-slate-300' }}">
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
    <main class="flex-1 flex flex-col h-full min-h-0 overflow-hidden bg-gray-50 dark:bg-slate-900 transition-colors duration-300">

    @if($selectedGroup)

        {{-- HEADER --}}
        <div class="h-16 flex items-center justify-between px-5 border-b border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800 flex-shrink-0">
            <div>
                <h2 class="font-semibold text-lg">{{ $selectedGroup->name }}</h2>
                <p class="text-xs text-slate-400">{{ $posts->count() }} posts</p>
            </div>
        </div>

            <!-- RIGHT COLUMN -->
    <div class="flex flex-col flex-1 overflow-hidden">   
        {{-- FEED --}}
    <div id="feedBox" class="flex-1 overflow-y-auto px-6 py-4 space-y-3">

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
                <span class="text-xs bg-gray-200 dark:bg-slate-700 text-gray-700 dark:text-slate-300 px-3 py-1 rounded-full">
                    {{ $post->created_at->format('d M Y') }}
                </span>
            </div>
        @endif

        {{-- POST --}}
        <div class="flex {{ $isMine ? 'justify-end pl-16' : 'justify-start pr-16' }}">

            <div class="max-w-[80%]">

                @if(!$isMine && !$sameUser)
                    <div class="text-xs font-semibold text-blue-500 mb-1 ml-2">
                       {{ $authorName }}
                    </div>
                @endif

                {{-- CLICKABLE BUBBLE --}}
                <div id="post-{{ $post->id }}"onclick="selectPost({{ $post->id }})" class=" {{ $isMine? 'bg-emerald-600 text-white rounded-br-md': 'bg-white dark:bg-slate-700 text-gray-900 dark:text-white rounded-bl-md' }} rounded-2xl px-4 py-3 shadow  cursor-pointer transition hover:shadow-lg max-w-xl">


                    {{-- TEXT --}}
                    @if($post->content)
                        <div class="mt-3 text-[15px] leading-7 text-gray-900 dark:text-white whitespace-pre-wrap break-words font-normal rounded border-l border-slate-700 px-3 py-2">
                          {{ $post->content }}
                        </div>
                    @endif

                    {{-- COMMENTS --}}
            @if($post->comments->count() > 0)

               <div class="mt-3 border-t border-slate-700 pt-3">

             {{-- Toggle --}}
        <button
            onclick="toggleComments(event, {{ $post->id }})"
            class="text-sm text-slate-400 hover:text-white transition text-sm font-semibold">
            💬{{ $post->comments->count() }}
            {{ Str::plural('comment', $post->comments->count()) }}
        </button>

        {{-- Comments Panel --}}
        <div id="comments-{{ $post->id }}"
             class="hidden mt-4 max-h-72 overflow-y-auto space-y-3">

            @foreach($post->comments as $comment)
                <div class="flex items-start gap-3">

                    {{-- Avatar --}}
                    <div
                        class="w-8 h-8 rounded-full bg-sky-500 flex items-center justify-center text-white text-xs font-bold shrink-0">
                        {{ strtoupper(substr($comment->student->username ?? $comment->lecturer->name ?? 'U', 0, 1)) }}
                    </div>

                    {{-- Comment --}}
                    <div class="flex-1">
                        <div class="bg-gray-100 dark:bg-slate-700 rounded-2xl px-3 py-2">
                            <p class="text-sm font-semibold text-black dark:text-white">
                                {{ $comment->student->username ?? $comment->lecturer->name ?? 'User' }}
                            </p>

                            <p class="text-sm text-slate-200 whitespace-pre-wrap break-words">
                                {{ $comment->content }}
                            </p>
                        </div>

                        <p class="text-xs text-slate-400 mt-1 ml-2">
                            {{ $comment->created_at->diffForHumans() }}
                        </p>
                    </div>

                </div>
            @endforeach

        </div>

    </div>

@endif

                    {{-- TIME --}}
                    <div class="text-[11px] opacity-70 mt-2 text-right">
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
        <div class="flex-shrink-0 border-t border-slate-800 bg-white dark:bg-slate-800 p-4">

            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="group_id" value="{{ $selectedGroup->id }}">

                <div class="flex gap-3 items-center">


                    <input type="text"
                           name="content"
                           placeholder="Type a message..."
                           class="flex-1 bg-slate-900 border border-slate-700 rounded-full px-4 py-3 text-sm mt-2 whitespace-pre-wrap break-words text-[15px] leading-7 focus:ring-2 focus:ring-green-500">

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

    function toggleComments(event, postId) {
    event.preventDefault();

    const panel = document.getElementById(`comments-${postId}`);

    panel.classList.toggle('hidden');
}
</script>
@endsection