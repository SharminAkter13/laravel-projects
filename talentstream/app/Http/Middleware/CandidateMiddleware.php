<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CandidateMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role?->name === 'candidate') {
            return $next($request);
        }

        abort(403, 'Access denied.');
    }
}
