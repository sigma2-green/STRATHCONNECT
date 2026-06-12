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
            'student_number' => ['required', 'string', 'max:255', 'unique:students'],

            'school' => ['required', 'in:SCES,SBS,SLS,SHS'],
            'course' => ['required', 'in:ICS,BBIT,BCOM,CNA,LAW,Philosophy'],
            'year_level' => ['required', 'in:1st Year,2nd Year,3rd Year,4th Year'],
            'group'  => ['required', 'in:A,B,C,D,E,F'],

            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        // 2. Create student
        $student = Student::create([
            'username' => $request->username,
            'email' => $request->email,
            'student_number' => $request->student_number,
        
            'school' => $request->school,
            'course' => $request->course,
            'group' => $request->group,
            'year_level' => $request->year_level,

            'password' => Hash::make($request->password),
        ]);
      // Find the matching group 
        $group = Group::where('school', $request->school)
    ->where('course', $request->course)
    ->where('year_level', $request->year_level)
    ->where('student_group', $request->group)
    ->first();
     
    // Assign the student to the appropriate group
    if (!$group) {
    return back()->withErrors([
        'group' => 'The selected group does not exist.'
    ])->withInput();
}

$student->groups()->attach($group->id);

        

        // 4. Redirect
        return redirect()->route('student.login')->with('success', 'Registration successful! Please log in.');
    }
}
