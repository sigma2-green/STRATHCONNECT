<?php

namespace App\Http\Controllers\lecturer;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

        'email' => [
            'required',
            'email',
            'max:255',
            'unique:lecturers',
            'ends_with:strathmore.edu',
        ],

        'staff' => [
            'required',
            'string',
            'max:6',
            'unique:lecturers,staff_number',
        ],

        'school' => [
            'required',
            'in:SCES,SBS,SLS,SHS',
        ],

        'course' => [
            'required',
            'in:ICS,BBIT,BCOM,CNA,LAW,Philosophy',
        ],

        'phone' => ['nullable', 'string', 'max:255'],

        'office' => ['nullable', 'string', 'max:255'],

        'password' => [
            'required',
            'confirmed',
            'min:6',
        ],
    ]);

    Lecturer::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'staff_number' => $validated['staff'],
        'school' => $validated['school'],
        'course' => $validated['course'],
        'phone' => $validated['phone'] ?? null,
        'office' => $validated['office'] ?? null,
        'approved' => false,
        'password' => Hash::make($validated['password']),
    ]);

    return redirect()
        ->route('lecturer.login')
        ->with(
            'success',
            'Registration successful! Your account will be activated after an administrator approves it.'
        );
}

}