<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index()
{
    $user = auth()->guard('student')->user();

    $approvedEvents = Event::where('status', 'approved')
        ->where('start_datetime', '>=', now())
        ->orderBy('start_datetime', 'asc')
        ->get();

    

    return view('event.index', compact(
        'approvedEvents',
    ));
}

    public function create()
    {
        return view('event.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:3000',
            'location' => 'required|string|max:255',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after:start_datetime',
        ]);

        Event::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'start_datetime' => $validated['start_datetime'],
            'end_datetime' => $validated['end_datetime'],
            'created_by' => Auth::guard('student')->id(),
            'status' => 'pending',
        ]);

        return redirect()
            ->route('event.index')
            ->with('success', 'Your event has been submitted for approval.');

       // redirect to login page if not logged in and clicks link 
       
    }
}