<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\Announcement;  


class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announcements = Announcement::latest()->get();

    return view('admin.announcements.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.announcements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'title' => 'required|max:255',
        'message' => 'required',
        ]);

        Announcement::create([
        'title' => $request->title,
        'message' => $request->message,
        'posted_by' => auth('admin')->user()->name,
        ]);

        return redirect()
        ->route('admin.announcements.index')
        ->with('success', 'Announcement posted successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $announcement = Announcement::findOrFail($id);

        return view('admin.announcements.edit', compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'message' => 'required',
        ]);

        $announcement = Announcement::findOrFail($id);

        $announcement->update([
            'title' => $request->title,
            'message' => $request->message,
        ]);

        return redirect()
            ->route('admin.announcements.index')
            ->with('success', 'Announcement updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
     //
     public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);

        $announcement->delete();

        return redirect()
            ->route('admin.announcements.index')
            ->with('success', 'Announcement deleted successfully!');
    }
}

