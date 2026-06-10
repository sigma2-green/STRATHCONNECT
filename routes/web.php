<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentRegisterController;
use App\Http\Controllers\StudentLoginController;
use App\Http\Controllers\lecturer\LoginController as LecturerLoginController;
use App\Http\Controllers\lecturer\RegisterController as LecturerRegisterController; 
/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', fn () => view('home'))->name('home');

/*
|--------------------------------------------------------------------------
| STUDENT AUTH (GUEST)
|--------------------------------------------------------------------------
*/

Route::middleware('guest:student')->group(function () {

    Route::get('/student/register', function () {
        return view('auth.register');
    })->name('student.register');

    Route::post('/student/register', [StudentRegisterController::class, 'store'])
        ->name('student.register.store');

    Route::get('/student/login', [StudentLoginController::class, 'showLoginForm'])
        ->name('student.login');

    Route::post('/student/login', [StudentLoginController::class, 'login'])
        ->name('student.login.submit');
});

/*
|--------------------------------------------------------------------------
| STUDENT AUTH (LOGGED IN)
|--------------------------------------------------------------------------
*/

Route::middleware('auth:student')->group(function () {

    Route::get('/student/dashboard', function () {
        return view('student.dashboard');
    })->name('student.dashboard');

    Route::post('/student/logout', [StudentLoginController::class, 'logout'])
        ->name('student.logout');

    /*
    | Verification (fix missing route error)
    */
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::post('/email/verification-notification', function () {
        return back()->with('status', 'verification-link-sent');
    })->name('verification.send');

    /*
    | Profile
    */
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


/* |--------------------------------------------------------------------------
| LECTURER  AUTHENTICATION AND LOGIN ROUTES
|--------------------------------------------------------------------------*/
Route::middleware('guest:lecturer')->group(function () {

    Route::get('/lecturer/sign-up', function () {
        return view('lecturer.sign-up');
    })->name('lecturer.register');

    Route::post('/lecturer/sign-up',
        [LecturerRegisterController::class, 'store'])
        ->name('lecturer.register.store');

    Route::get('/lecturer/login',
        [LecturerLoginController::class, 'showLoginForm'])
        ->name('lecturer.login');

    Route::post('/lecturer/login',
        [LecturerLoginController::class, 'login'])
        ->name('lecturer.login.submit');
        
    Route::get('/lecturer/profile', function () {
        return view('lecturer.profile');
    })->name('lecturer.profile');
});

Route::middleware('auth:lecturer')->group(function () {

    Route::get('/lecturer/dashboard', function () {
        return view('lecturer.dashboard');
    })->name('lecturer.dashboard');

    Route::post('/lecturer/logout',
        [LecturerLoginController::class, 'logout'])
        ->name('lecturer.logout');
});