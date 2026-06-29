<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display all approved upcoming events
     */
    public function index()
    {
        $approvedEvents = Event::with([
                'creatorStudent',
                'creatorLecturer'
            ])
            ->where('status', 'approved')
            ->where('start_datetime', '>=', now())
            ->orderBy('start_datetime', 'asc')
            ->get();

        return view('event.index', compact('approvedEvents'));
    }

    /**
     * Show create event form
     */
    public function create()
    {
        return view('event.create');
    }

    /**
     * Store new event
     */
    public function store(Request $request)
    {
       $validated = $request->validate([
    'title' => 'required|string|max:255',
    'description' => 'nullable|string|max:3000',
    'location' => 'required|string|max:255',
    'banner' => 'nullable|image|max:5120',
    'capacity' => 'nullable|integer|min:1',
    'visibility' => 'required|in:public,school,course,group,club',
    'start_datetime' => 'required|date',
    'end_datetime' => 'required|date',
]);

if (strtotime($validated['end_datetime']) <= strtotime($validated['start_datetime'])) {
    return back()
        ->withErrors([
            'end_datetime' => 'The end date and time must be after the start date and time.'
        ])
        ->withInput();
}

        /*
        |--------------------------------------------------------------------------
        | Upload Banner
        |--------------------------------------------------------------------------
        */

        $bannerPath = null;

        if ($request->hasFile('banner')) {

            $bannerPath = $request
                ->file('banner')
                ->store('events', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Detect Logged-in User
        |--------------------------------------------------------------------------
        */

        $student = Auth::guard('student')->user();

        $lecturer = Auth::guard('lecturer')->user();

        /*
        |--------------------------------------------------------------------------
        | Save Event
        |--------------------------------------------------------------------------
        */

        Event::create([

            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'location' => $validated['location'],
            'banner' => $bannerPath,
            'capacity' => $validated['capacity'] ?? null,
            'visibility' => $validated['visibility'],
            'start_datetime' => $validated['start_datetime'],
            'end_datetime' => $validated['end_datetime'],
            'created_by_student_id' => $student?->id,
            'created_by_lecturer_id' => $lecturer?->id,
            // every event awaits approval
            'status' => 'pending',
        ]);

        return redirect()
            ->route('event.index')
            ->with('success', 'Your event has been submitted for approval.');
    }
}