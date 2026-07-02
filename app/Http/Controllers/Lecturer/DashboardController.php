<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $lecturer = Auth::guard('lecturer')->user();

        $approvedEvents = Event::with([
                'creatorStudent',
                'creatorLecturer',
            ])
            ->where('status', 'approved')
            ->where('start_datetime', '>=', now())
            ->orderBy('start_datetime', 'asc')
            ->get();
        return view('lecturer.dashboard', compact('lecturer', 'approvedEvents'));
    }
}