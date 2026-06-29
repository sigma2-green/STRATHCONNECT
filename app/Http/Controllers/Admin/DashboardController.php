<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Admin;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count();
        $totalAdmins = Admin::count();
        
        return view('admin.dashboard', compact('totalStudents', 'totalAdmins'));
    }

    public function students()
    {
        $students = Student::all();
        return view('admin.students', compact('students'));
    }
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('admin.students-edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'student_number' => 'required|string|max:255',
            'school' => 'nullable|string|max:255',
            'course' => 'nullable|string|max:255',
            'group' => 'nullable|string|max:255',
        ]);

        $student->update([
            'username' => $request->username,
            'email' => $request->email,
            'student_number' => $request->student_number,
            'school' => $request->school,
            'course' => $request->course,
            'group' => $request->group,
        ]);

        return redirect()->route('admin.students')->with('success', 'Student updated successfully!');
    }
    public function destroy($id)
    {
        $student = Student::findOrFail($id);

        $student->delete();

        return redirect()
            ->route('admin.students')
            ->with('success', 'Student deleted successfully!');
    }
}
