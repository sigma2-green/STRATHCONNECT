@extends('layouts.ui')

@section('content')

<div class="flex h-screen bg-gray-100 dark:bg-slate-900 text-gray-900 dark:text-white transition-colors duration-300">

    {{-- ================= SIDEBAR ================= --}}
    <aside class="w-72 bg-white dark:bg-slate-900 border-r border-gray-200 dark:border-slate-700 flex flex-col">

        <div class="h-16 flex items-center justify-center border-b border-gray-200 dark:border-slate-700">
            <h1 class="text-xl font-bold text-blue-600">
                STRATHCONNECT
            </h1>
        </div>

        <div class="flex-1 overflow-y-auto px-4 py-4 space-y-5">

            <a href="{{ route('lecturer.announcements') }}"
               class="w-full h-28 rounded-2xl bg-blue-600 text-white flex items-center gap-4 px-6 shadow hover:scale-[1.02] transition">

                <span class="text-3xl">📢</span>

                <div>
                    <div class="font-bold">
                        Announcements
                    </div>

                    <div class="text-sm opacity-80">
                        View latest news
                    </div>
                </div>

            </a>

            @foreach([
                'SCHOOL'=>$schoolGroups,
                'COURSE'=>$courseGroups
            ] as $label=>$groups)

                <div>

                    <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-slate-400 mb-2 px-2">
                        {{ $label }}
                    </p>

                    <div class="space-y-1">

                        @forelse($groups as $group)

                            <a
                                href="{{ route('lecturer.dashboard',['group'=>$group->id]) }}"

                                class="block rounded-lg px-3 py-2 text-sm transition

                                {{ request('group')==$group->id

                                    ? 'bg-blue-600 text-white'

                                    : 'text-gray-700 dark:text-slate-300 hover:bg-gray-100 dark:hover:bg-slate-800'

                                }}">

                                {{ $group->name }}

                            </a>

                        @empty

                            <p class="text-xs text-gray-400 px-3">
                                No groups
                            </p>

                        @endforelse

                    </div>

                </div>

            @endforeach

        </div>

    </aside>

    {{-- ================= MAIN ================= --}}
    <main class="flex-1 flex flex-col bg-gray-50 dark:bg-slate-900 overflow-hidden">

    @if($selectedGroup)

        {{-- HEADER --}}
        <div class="h-16 px-6 flex items-center justify-between bg-white dark:bg-slate-800 border-b border-gray-200 dark:border-slate-700 shadow-sm">

            <div>

                <h2 class="font-semibold text-lg">
                    {{ $selectedGroup->name }}
                </h2>

                <p class="text-xs text-gray-500 dark:text-slate-400">

                    {{ $posts->count() }}

                    posts

                </p>

            </div>

        </div>

        {{-- CHAT AREA --}}
        <div class="flex-1 flex flex-col overflow-hidden">

            <div
                id="feedBox"
                class="flex-1 overflow-y-auto px-6 py-5 space-y-3">

@php
    $prevUser = null;
@endphp

    @forelse($posts->sortBy('created_at') as $post)

    @php
        $isMine =
            ($post->student_id && $post->student_id == Auth::guard('student')->id()) ||
            ($post->lecturer_id && $post->lecturer_id == Auth::guard('lecturer')->id());

        $currentUser = $post->student_id ?? ('L'.$post->lecturer_id);

        $sameUser = $prevUser === $currentUser;
        $prevUser = $currentUser;

        $authorName =
            $post->student->username
            ?? $post->lecturer->name
            ?? 'Unknown User';
    @endphp

    {{-- DATE SEPARATOR --}}
    @if(
        $loop->first ||
        $posts->sortBy('created_at')->values()[$loop->index - 1]
            ->created_at->format('Y-m-d')
            !=
        $post->created_at->format('Y-m-d')
    )

        <div class="flex justify-center my-5">

            <span class="px-4 py-1 rounded-full bg-gray-200 dark:bg-slate-700 text-gray-700 dark:text-slate-300 text-xs shadow">

                {{ $post->created_at->format('d M Y') }}

            </span>

        </div>

    @endif


    {{-- MESSAGE --}}
    <div class="flex {{ $isMine ? 'justify-end pl-16' : 'justify-start pr-16' }}">

        <div class="max-w-xl">

            @if(!$isMine && !$sameUser)

                <div class="ml-3 mb-1 text-xs font-semibold text-blue-600 dark:text-blue-400">

                    {{ $authorName }}

                </div>

            @endif

            <div
                id="post-{{ $post->id }}"
                onclick="selectPost({{ $post->id }})"

                class="
                    cursor-pointer
                    transition-all
                    hover:shadow-lg
                    shadow
                    px-4
                    py-3
                    rounded-2xl

                    {{ $isMine
                        ? 'bg-emerald-500 text-white rounded-br-md'
                        : 'bg-white dark:bg-slate-700 text-gray-900 dark:text-white rounded-bl-md'
                    }}
                ">

                {{-- MESSAGE TEXT --}}
                @if($post->content)

                    <div class="whitespace-pre-wrap break-words leading-7">

                        {{ $post->content }}

                    </div>

                @endif


                {{-- COMMENTS --}}
                @if($post->comments->count())

                    <div class="mt-4 border-t border-gray-300 dark:border-slate-600 pt-3">

                        <button
                            onclick="toggleComments(event, {{ $post->id }})"
                            class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:underline">

                            💬 {{ $post->comments->count() }}
                            {{ Str::plural('comment', $post->comments->count()) }}

                        </button>

                        <div
                            id="comments-{{ $post->id }}"
                            class="hidden mt-4 space-y-3 max-h-72 overflow-y-auto">

                            @foreach($post->comments as $comment)

                                <div class="flex gap-3">

                                    <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white text-xs font-bold">

                                        {{ strtoupper(substr($comment->student->username ?? $comment->lecturer->name ?? 'U',0,1)) }}

                                    </div>

                                    <div class="flex-1">

                                        <div class="rounded-2xl bg-gray-100 dark:bg-slate-600 px-3 py-2">

                                            <p class="font-semibold text-sm">

                                                {{ $comment->student->username ?? $comment->lecturer->name ?? 'User' }}

                                            </p>

                                            <p class="text-sm whitespace-pre-wrap break-words">

                                                {{ $comment->content }}

                                            </p>

                                        </div>

                                        <div class="ml-2 mt-1 text-xs text-gray-500 dark:text-slate-400">

                                            {{ $comment->created_at->diffForHumans() }}

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                @endif


                {{-- TIME --}}
                <div class="text-right text-[11px] opacity-70 mt-2">

                    {{ $post->created_at->format('H:i') }}

                </div>

            </div>

        </div>

    </div>

@empty

<div class="flex flex-1 items-center justify-center text-center text-gray-500 dark:text-slate-400">

    <div>

        <div class="text-6xl mb-3">

            💬

        </div>

        <p>

            No posts yet

        </p>

    </div>

</div>

@endforelse

</div>

{{-- WHATSAPP-STYLE COMMENT BAR (GLOBAL, NOT PER POST) --}}
{{-- ================= COMMENT BAR ================= --}}
<div
    id="commentBar"
    class="hidden flex-shrink-0 border-t border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-3">

    <form
        action="{{ route('comments.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="flex items-center gap-3 w-full">

        @csrf

        <input
            type="hidden"
            name="post_id"
            id="activePostId">

        <input
            id="commentInput"
            type="text"
            name="content"
            placeholder="Write a comment..."
            required
            class="flex-1 rounded-full border border-gray-300 dark:border-slate-600 bg-gray-100 dark:bg-slate-900 text-gray-900 dark:text-white px-5 py-3 focus:ring-2 focus:ring-blue-500">

        <button
            type="submit"
            class="h-11 w-11 rounded-full bg-blue-600 hover:bg-blue-700 text-white transition">

            ➤

        </button>

    </form>

</div>

{{-- ================= MESSAGE INPUT ================= --}}
<div
    class="flex-shrink-0 border-t border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-4">

    <form
        action="{{ route('lecturer.posts.store') }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        <input
            type="hidden"
            name="group_id"
            value="{{ $selectedGroup->id }}">

        <div class="flex items-center gap-3">

            <input
                type="text"
                name="content"
                placeholder="Type a message..."
                class="flex-1 rounded-full border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-black dark:text-white px-5 py-3 focus:ring-2 focus:ring-green-500">

            <button
                type="submit"
                class="w-12 h-12 rounded-full bg-green-600 hover:bg-green-700 text-white transition">

                ➤

            </button>

        </div>

    </form>

</div>

@else

<div class="flex-1 flex items-center justify-center">

    <div class="text-center text-gray-500 dark:text-slate-400">

        <div class="text-7xl mb-4">

            💬

        </div>

        <h2 class="text-2xl font-bold mb-2">

            Lecturer Dashboard

        </h2>

        <p>

            Select a group to begin.

        </p>

    </div>

</div>

@endif

</main>

</div>

{{-- IMAGE MODAL --}}
<div
    id="imageModal"
    class="hidden fixed inset-0 bg-black/90 flex items-center justify-center z-50">

    <img
        id="modalImg"
        class="max-h-full max-w-full rounded-lg">

</div>

<script>

let selectedPostId = null;

function selectPost(postId){

    selectedPostId = postId;

    document.getElementById('activePostId').value = postId;

    document
        .getElementById('commentBar')
        .classList
        .remove('hidden');

    document
        .querySelectorAll('[id^="post-"]')
        .forEach(post => {

            post.classList.remove(
                'ring-2',
                'ring-blue-500'
            );

        });

    document
        .getElementById('post-'+postId)
        .classList
        .add(
            'ring-2',
            'ring-blue-500'
        );

    setTimeout(() => {

        document
            .getElementById('commentInput')
            .focus();

    },100);

}

function toggleComments(event,id){

    event.stopPropagation();

    document
        .getElementById('comments-'+id)
        .classList
        .toggle('hidden');

}

const feed=document.getElementById('feedBox');

if(feed){

    feed.scrollTop=feed.scrollHeight;

}

function openImage(src){

    document
        .getElementById('modalImg')
        .src=src;

    document
        .getElementById('imageModal')
        .classList
        .remove('hidden');

}

document
    .getElementById('imageModal')
    ?.addEventListener('click',function(){

        this.classList.add('hidden');

    });

</script>

@endsection