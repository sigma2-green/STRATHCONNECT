<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Admin;
use App\Models\Lecturer;
use App\Models\Event;


class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count();
        $totalAdmins = Admin::count();
        $totalLecturers = Lecturer::count();
        $totalEvents = Event::count();
        $pendingEvents = Event::where('status', 'pending')->count();
    
        
        return view('admin.dashboard', compact('totalStudents', 'totalAdmins', 'totalLecturers', 'totalEvents', 'pendingEvents'));
    }

    public function students()
    {
        $students = Student::all();
        return view('admin.students', compact('students'));
    }

    public function lecturers()
    {
        $lecturers = Lecturer::all();
        return view('admin.lecturers', compact('lecturers'));
    }

    public function admins()
    {
        $admins = Admin::all();
        return view('admin.index', compact('admins'));
    }

    public function pendingEvents()
    {
        $pendingEvents = Event::where('status', 'pending')->get();
        return view('admin.events.pending', compact('pendingEvents'));
    }

    public function approveEvent(Event $event)
    {
        $event->status = 'approved';
        $event->save();

        return redirect()->route('admin.events.pending')->with('success', 'Event approved successfully.');
    }

    public function rejectEvent(Event $event)
    {
        $event->status = 'cancelled';
        $event->save();

        return redirect()->route('admin.events.pending')->with('success', 'Event rejected successfully.');
    }

    public function events()
    {
        $events = Event::all();
        return view('admin.events.index', compact('events'));
    }
    
    public function deleteEvent(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }
    /*public function assignments()
    {
        $lecturers = Lecturer::with('classes')->get();
        return view('admin.assign', compact('lecturers'));
    }*/

    public function createAssignment()
    {
        
        return view('admin.assignments.create');
    }

    public function storeAssignment(Request $request)
    {
        // Validate and store the assignment

    }

    public function editAssignment($assignmentId)
    {
        // Fetch the assignment and return the edit view

    }

    public function updateAssignment(Request $request, $assignmentId)
    {
        // Validate and update the assignment

    }

    public function destroyAssignment($assignmentId)
    {
        // Delete the assignment

    }

    public function showAssignmentLecturers($assignmentId)
    {
        // Fetch the assignment and its lecturers
    }

    public function addLecturerToAssignment(Request $request, $assignmentId)
    {
        // Add a lecturer to the assignment
    }

    public function assign(){
        
        return view('admin.assign');
    }
    
}
