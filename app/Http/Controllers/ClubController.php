<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Club;





class ClubController extends Controller
{
public function join(Club $club)
{
    $student = auth()->guard('student')->user();

    $club->members()->syncWithoutDetaching($student->id);

    return back()->with('success', 'Joined club successfully!');
}

public function index()
{
    $student = auth()->guard('student')->user();

    if ($student) {

        $myClubs = $student->clubs()->get();

        $discoverClubs = Club::whereDoesntHave('members', function ($query) use ($student) {
            $query->where('students.id', $student->id);
        })->get();

    } else {

        // lecturer view
        $myClubs = collect();
        $discoverClubs = Club::all();
    }

    return view('clubs.index', compact(
        'myClubs',
        'discoverClubs'
    ));
}
    public function create()
{
    return view('clubs.create');
}
public function store(Request $request)
{
    $student = auth()->guard('student')->user();

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'category' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'logo' => 'nullable|image|max:2048',
        'banner' => 'nullable|image|max:5120',
    ]);

    $logoPath = null;
    $bannerPath = null;

    if ($request->hasFile('logo')) {
        $logoPath = $request->file('logo')->store('clubs/logos', 'public');
    }

    if ($request->hasFile('banner')) {
        $bannerPath = $request->file('banner')->store('clubs/banners', 'public');
    }

    $club = Club::create([
        'name' => $validated['name'],
        'category' => $validated['category'],
        'description' => $validated['description'] ?? null,
        'logo' => $logoPath,
        'banner' => $bannerPath,
        'status' => 'pending', // optional approval workflow
        'created_by' => $student->id,
    ]);

    // Creator automatically becomes a member
    $club->members()->attach($student->id);

    return redirect()
        ->route('clubs.index')
        ->with('success', 'Club created successfully!');
}
}
