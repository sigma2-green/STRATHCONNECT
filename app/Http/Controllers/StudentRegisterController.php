<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
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

            'school' => ['required', 'in:SCES,SBS,SLS,SHS,SIT,SOM,SOE'],
            'course' => ['required', 'in:ICS,BBIT,LAW'],
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

            'password' => Hash::make($request->password),
        ]);

        

        // 4. Redirect
        return redirect()->route('student.login')->with('success', 'Registration successful! Please log in.');
    }
}
