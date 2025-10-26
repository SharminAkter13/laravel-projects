<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request; 

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
protected function authenticated(Request $request, $user)
{
    // Safe null-check with ?-> (PHP 8+)
    $roleName = $user->role?->name;

    if ($roleName === 'admin') {
        return redirect()->route('admin.dashboard'); // Admin dashboard
    } elseif ($roleName === 'employer' || $roleName === 'candidate') {
        return redirect()->route('portal.dashboard'); // Portal dashboard
    }

    return redirect()->route('portal.home'); // fallback
}
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
