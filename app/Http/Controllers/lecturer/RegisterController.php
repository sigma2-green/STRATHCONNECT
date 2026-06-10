<?php

namespace App\Http\Controllers\lecturer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Lecturer;



class RegisterController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validate input
        $validatedData = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:lecturers'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:lecturers'],
            'staff' => ['required', 'string', 'max:255', 'unique:lecturers,staff_number'],
            'school' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // 2. Create lecturer
        $lecturer = Lecturer::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'staff_number' => $request->input('staff'),
            'school' => $request->input('school'),
            'department' => $request->input('department'),
            'password' => Hash::make($request->input('password')),
        ]);
    

        // 4. Redirect to login
        return redirect()->route('lecturer.login')->with('success', 'Registration successful!');
    }
}
