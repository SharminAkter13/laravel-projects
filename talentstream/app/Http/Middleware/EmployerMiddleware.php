<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EmployerMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role?->name === 'employer') {
            return $next($request);
        }

        abort(403, 'Access denied.');
    }
}
