<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Event;
use App\Models\Post;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {

    $user = $request->user();

    $myEvents = Event::where('created_by', $user->id)
        ->orderBy('created_at', 'desc')
        ->get();
        
        return view('profile.edit', [
            'user' => $user,
            'myEvents' => $myEvents,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
{
    $student = Auth::guard('student')->user();

    $request->validate([
        'username' => ['required', 'string', 'max:255', 'unique:students,username,' . $student->id],
        'email' => ['required', 'email', 'unique:students,email,' . $student->id],
    ]);

    $student->fill([
        'username' => $request->username,
        'email' => $request->email,

    ]);

    // optional email verification reset
    if ($student->isDirty('email')) {
        $student->email_verified_at = null;
    }

    $student->save();

    return back()->with('status', 'profile-updated');
}

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $student = Auth::guard('student')->user();

// Delete events created by the student
        Event::where('created_by', $student->id)->delete();

        Post::where('student_id', $student->id)->delete();

        Auth::guard('student')->logout();

         $student->delete();

         $request->session()->invalidate();
         $request->session()->regenerateToken();

        return redirect()->route('home')->with('status', 'Account deleted successfully.');
    }
}
