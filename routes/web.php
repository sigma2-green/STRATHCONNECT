<?php

use App\Http\Controllers\Auth\EmailVerificationPromptController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Group;
use App\Models\Post;

/* IMPORT CONTROLLERS */
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentRegisterController;
use App\Http\Controllers\StudentLoginController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
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

Route::middleware('guest:student')->group(function () {

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
        Route::get('lecturers', [DashboardController::class, 'lecturers'])->name('lecturers');
        Route::get('admins', [DashboardController::class, 'admins'])->name('index');
        Route::get('assign', [DashboardController::class, 'assign'])->name('assign');
        //Route::get('assignments', [DashboardController::class, 'assignments'])->name('assignments');
       // Route::get('assignments/create', [DashboardController::class, 'createAssignment'])->name('assignments.create');
       // Route::post('assignments', [DashboardController::class, 'storeAssignment'])->name('assignments.store');
       // Route::get('assignments/{assignment}/edit', [DashboardController::class, 'editAssignment'])->name('assignments.edit');
        //Route::put('assignments/{assignment}', [DashboardController::class, 'updateAssignment'])->name('assignments.update');
        //Route::delete('assignments/{assignment}', [DashboardController::class, 'destroyAssignment'])->name('assignments.destroy');
        //Route::get('assignments/{assignment}/lecturers', [DashboardController::class, 'showAssignmentLecturers'])->name('assignments.lecturers');
        //Route::post('assignments/{assignment}/lecturers', [DashboardController::class, 'addLecturerToAssignment'])->name('assignments.lecturers.add');  
        Route::get('events', [DashboardController::class, 'events'])->name('events.index');
        Route::get('events/pending', [DashboardController::class, 'pendingEvents'])->name('events.pending');
        Route::post('events/{event}/approve', [DashboardController::class, 'approveEvent'])->name('events.approve');
        Route::post('events/{event}/reject', [DashboardController::class, 'rejectEvent'])->name('events.reject'); 
        Route::delete('events/{event}', [DashboardController::class, 'deleteEvent'])->name('events.delete');
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
    

    
});

Route::middleware('auth:lecturer')->group(function () {

    Route::get('/lecturer/dashboard', [LecturerDashboardController::class, 'index'])
        ->name('lecturer.dashboard');

     Route::get('lecturer/events', [EventController::class, 'index'])
        ->name('lecturer.event.index');

    Route::get('/lecturer/events/create', [EventController::class, 'create'])
        ->name('lecturer.event.create');

    Route::post('/lecturer/events', [EventController::class, 'store'])
        ->name('lecturer.event.store');

    Route::post('/lecturer/logout', [LecturerLoginController::class, 'logout'])
        ->name('lecturer.logout');
});

    

    

