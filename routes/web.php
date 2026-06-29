<?php

use App\Http\Controllers\Auth\EmailVerificationPromptController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Group;
use App\Models\Post;

/* IMPORT CONTROLLERS */
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
use App\Http\Controllers\Student\PostController;
use App\Http\Controllers\Student\CommentController; // ✅ FIXED
use App\Http\Controllers\Student\EventController; // ✅ NEW
use App\Http\Controllers\Student\PasswordController; // ✅ NEW
use App\Http\Controllers\ClubController; // ✅ NEW
use App\Http\Controllers\Lecturer\DashboardController as LecturerDashboardController;
use App\Http\Controllers\Lecturer\LoginController as LecturerLoginController;
use App\Http\Controllers\Lecturer\RegisterController as LecturerRegisterController;

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

    Route::get('/student/register', fn () => view('auth.register'))
        ->name('student.register');

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


    Route::get('/student/announcements',
        [StudentAnnouncementController::class, 'index'])
        ->name('student.announcements');

    Route::post('/student/logout', [StudentLoginController::class, 'logout'])
        ->name('student.logout');
    Route::put('/password', [PasswordController::class, 'update'])
    ->name('password.update');

    /*
    |--------------------------------------------------------------------------
    | CLUBS
    |--------------------------------------------------------------------------
    */

    Route::get('/clubs', [ClubController::class, 'index'])
        ->name('clubs.index');

    Route::get('/clubs/create', [ClubController::class, 'create'])
        ->name('clubs.create');

    Route::post('/clubs', [ClubController::class, 'store'])
        ->name('clubs.store');

    Route::post('/clubs/{club}/join', [ClubController::class, 'join'])
        ->name('clubs.join');

    /*
    |--------------------------------------------------------------------------
    | EVENTS
    |--------------------------------------------------------------------------
    */

    Route::get('/events', [EventController::class, 'index'])
        ->name('event.index');

    Route::get('/events/create', [EventController::class, 'create'])
        ->name('event.create');

    Route::post('/events', [EventController::class, 'store'])
        ->name('event.store');

    /*
    | DASHBOARD
    */
    Route::get('/student/dashboard', function (Request $request) {

        $student = Auth::guard('student')->user();

        // GROUPS
        $baseQuery = fn($type) => Group::where('type', $type)
            ->where('school', $student->school);

        $schoolGroups = (clone $baseQuery('school'))->get();

        $courseGroups = (clone $baseQuery('course'))
            ->where('course', $student->course)
            ->get();

        $yearGroups = (clone $baseQuery('year'))
            ->where('course', $student->course)
            ->where('year_level', $student->year_level)
            ->get();

        $classGroups = (clone $baseQuery('class'))
            ->where('course', $student->course)
            ->where('year_level', $student->year_level)
            ->where('class_group', $student->class_group)
            ->get();

        /*
        | SELECTED GROUP + POSTS + COMMENTS (FIXED)
        */
        $selectedGroup = null;
        $posts = collect();

        if ($request->filled('group')) {

            $selectedGroup = Group::find($request->group);

            if ($selectedGroup) {
                $posts = Post::with([
                        'student',
                        'lecturer',
                        'comments.student',
                        'comments.lecturer'
                    ])
                    ->where('group_id', $selectedGroup->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
            }
           
        }

        return view('student.dashboard', compact(
            'schoolGroups',
            'courseGroups',
            'yearGroups',

            'classGroups',
            'selectedGroup',
            'posts'
        ));
    })->name('student.dashboard');

    /*
    | POSTS
    */
    Route::post('/student/posts', [PostController::class, 'store'])
        ->name('posts.store');

    /*
    | COMMENTS (FIXED)
    */
    Route::post('/comments', [CommentController::class, 'store'])
        ->name('comments.store');
    /*
    | LOGOUT
    */
    Route::post('/student/logout', [StudentLoginController::class, 'logout'])
        ->name('student.logout');

    /*
    | PROFILE
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


/*|--------------------------------------------------------------------------
| LECTURER AUTH
|--------------------------------------------------------------------------
*/



Route::middleware('guest:lecturer')->group(function () {

    Route::get('/lecturer/sign-up', fn () => view('lecturer.sign-up'))
        ->name('lecturer.register');

    Route::post('/lecturer/sign-up', [LecturerRegisterController::class, 'store'])
        ->name('lecturer.register.store');

    Route::get('/lecturer/login', [LecturerLoginController::class, 'showLoginForm'])
        ->name('lecturer.login');

    Route::post('/lecturer/login', [LecturerLoginController::class, 'login'])
        ->name('Lecturer.login.submit');

    Route::get('/lecturer/profile', fn () => view('lecturer.profile'))
        ->name('lecturer.profile');
});

Route::middleware('auth:lecturer')->group(function () {

    Route::get('/lecturer/dashboard', [LecturerDashboardController::class, 'index'])
        ->name('lecturer.dashboard');

    Route::post('/lecturer/logout', [LecturerLoginController::class, 'logout'])
        ->name('lecturer.logout');
});

    

    

