<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class  PostController extends Controller
{
   public function store(Request $request)
{
    $validated = $request->validate([
        'group_id' => 'required|exists:groups,id',
        'content' => 'nullable|string|max:5000',
    ]);


$post = Post::create([
    'lecturer_id' => Auth::guard('lecturer')->id(),
    'group_id' => $validated['group_id'],
    'content' => $validated['content'],
]);

return redirect()->route('lecturer.dashboard', [
    'group' => $validated['group_id']
]);

}
}
