<?php

namespace App\Http\Controllers\lecturer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('lecturer.login');
    }

    public function login(Request $request){
    // Use the login form instead
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required']
        ]);

        if (auth()->guard('lecturer')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('lecturer.dashboard')->with('success', 'Login successful!');
        }

        return back()->withErrors([
            'username' => 'Invalid username or password.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        auth()->guard('lecturer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('lecturer.login')->with('success', 'Logged out successfully!');
    }
    
}
