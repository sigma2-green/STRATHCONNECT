<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\StudentRegisterController;
use App\Http\Controllers\StudentLoginController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Student\AnnouncementController as StudentAnnouncementController;

Route::get('/login', function () {
    return redirect('/student/login');
})->name('login');

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

Route::group([], function () {

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

    Route::get('/student/announcements',
        [StudentAnnouncementController::class, 'index'])
        ->name('student.announcements');

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

    
/*
|--------------------------------------------------------------------------
| ADMIN AUTH
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login'])->name('login.submit');
    });
    
    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('students', [DashboardController::class, 'students'])->name('students'); 
        Route::get('announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
        Route::get('announcements/create', [AnnouncementController::class, 'create'])
            ->name('announcements.create');
        Route::post('announcements', [AnnouncementController::class, 'store'])
            ->name('announcements.store');
        Route::get('announcements/{announcement}/edit', [AnnouncementController::class, 'edit'])
            ->name('announcements.edit');
        Route::put('announcements/{announcement}', [AnnouncementController::class, 'update'])
            ->name('announcements.update');
        Route::delete('announcements/{announcement}', [AnnouncementController::class, 'destroy'])
            ->name('announcements.destroy');
        Route::get('events', [\App\Http\Controllers\Admin\EventController::class, 'index'])
            ->name('events.index');
        Route::get('events/create', [\App\Http\Controllers\Admin\EventController::class, 'create'])
            ->name('events.create');
        Route::post('events', [\App\Http\Controllers\Admin\EventController::class, 'store'])
            ->name('events.store');
        Route::get('events/{event}/edit', [\App\Http\Controllers\Admin\EventController::class, 'edit'])
            ->name('events.edit');
        Route::put('events/{event}', [\App\Http\Controllers\Admin\EventController::class, 'update'])
            ->name('events.update');
        Route::delete('events/{event}', [\App\Http\Controllers\Admin\EventController::class, 'destroy'])
            ->name('events.destroy');
        Route::get('students/{id}/edit', [DashboardController::class, 'edit'])->name('students.edit');  
        Route::put('students/{id}', [DashboardController::class, 'update'])->name('students.update');
        Route::delete('students/{id}', [DashboardController::class, 'destroy'])->name('students.destroy');
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    
    });
});