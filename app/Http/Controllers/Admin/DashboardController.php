<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Admin;

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
}