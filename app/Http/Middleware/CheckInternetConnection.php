<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckInternetConnection
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
   public function handle($request, Closure $next)
{
    if (!@fsockopen("google.com", 80)) {
        abort(503, 'Internet connection is required.');
    }

    return $next($request);
}
}
