<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
public function store(Request $request)
{
    $validated = $request->validate([
        'group_id' => 'required|exists:groups,id',
        'content' => 'nullable|string|max:5000',
    ]);


$post = Post::create([
    'student_id' => Auth::guard('student')->id(),
    'group_id' => $validated['group_id'],
    'content' => $validated['content'],
]);

return redirect()->route('student.dashboard', [
    'group' => $validated['group_id']
]);

}


}
