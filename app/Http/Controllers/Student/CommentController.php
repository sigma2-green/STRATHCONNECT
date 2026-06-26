<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string|max:2000',
        ]);

        Comment::create([
            'post_id'      => $validated['post_id'],
            'content'      => $validated['content'],
            'student_id'   => Auth::guard('student')->id(),
            'lecturer_id'  => Auth::guard('lecturer')->id(),
            'parent_id'    => $request->parent_id, // for future replies
        ]);

        return redirect()->back();
    }
}