<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class StudentRegisterController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validate input
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:students'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:students'],
            'student_number' => ['required', 'string', 'min:6', 'max:6', 'unique:students'],

            'school' => ['required', 'in:SCES,SBS,SLS,SHS'],
            'course' => ['required', 'in:ICS,BBIT,BCOM,CNA,LAW,Philosophy'],
            'year_level' => ['required', 'in:1st Year,2nd Year,3rd Year,4th Year'],
            'class_group' => 'required|in:A,B,C,D,E,F',

            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        // 2. Create student
        $student = Student::create([
            'username' => $request->username,
            'email' => $request->email,
            'student_number' => $request->student_number,
        
            'school' => $request->school,
            'course' => $request->course,
            'class_group' => $request->class_group,
            'year_level' => $request->year_level,

            'password' => Hash::make($request->password),
        ]);
      // Find the matching group 
        $groups = Group::where(function ($query) use ($request) {

        $query->where(function ($q) use ($request) {
           $q->where('type', 'school')
             ->where('school', $request->school);
      })

    ->orWhere(function ($q) use ($request) {
        $q->where('type', 'course')
          ->where('school', $request->school)
          ->where('course', $request->course);
    })

    ->orWhere(function ($q) use ($request) {
        $q->where('type', 'year')
          ->where('school', $request->school)
          ->where('course', $request->course)
          ->where('year_level', $request->year_level);
    })

    ->orWhere(function ($q) use ($request) {
        $q->where('type', 'class')
          ->where('school', $request->school)
          ->where('course', $request->course)
          ->where('year_level', $request->year_level)
          ->where('class_group', $request->class_group);
    });

 })->get();

 $student->groups()->attach($groups->pluck('id'));


        

        // 4. Redirect
        return redirect()->route('student.login')->with('success', 'Registration successful! Please log in.');
    }
}
