<?php

use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illluminate\Foundation\Configuration\Routing;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

    $middleware->alias([
        'student_or_lecturer' => \App\Http\Middleware\StudentOrLecturer::class,
    ]);

    $middleware->redirectGuestsTo(function (Request $request) {

        if ($request->is('lecturer/*')) {
            return route('lecturer.login');
        }

        return route('home');
    });
})
    
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();