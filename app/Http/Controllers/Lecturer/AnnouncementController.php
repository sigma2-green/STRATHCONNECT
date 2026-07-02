<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
   public function index(Request $request)
   {
       $lecturer = $request->user('lecturer');
       $announcements = Announcement::latest()->get();
       return view('lecturer.announcements.index', compact('lecturer', 'announcements'));
   }
}
