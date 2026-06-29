<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $lecturer = Auth::guard('lecturer')->user();

        return view('lecturer.dashboard', compact('lecturer'));
    }
}