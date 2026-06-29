<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class PasswordController extends Controller
{
    public function update(Request $request)
    {
        $student = Auth::guard('student')->user();

        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        if (! Hash::check($request->current_password, $student->password)) {
            return back()->withErrors([
                'current_password' => 'Current password is incorrect.',
            ], 'updatePassword');
        }

        $student->password = Hash::make($request->password);
        $student->save();

        return back()->with('status', 'password-updated');
    }
}