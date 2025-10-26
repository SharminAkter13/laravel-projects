<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role?->name === 'admin') {
            return $next($request);
        }

        if (Auth::check()) {
            // Logged in but not admin → send to user portal
            return redirect()->route('portal.dashboard');
        }

        // Guest → send to public homepage
        return redirect()->route('portal.home');
    }
}
