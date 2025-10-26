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
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard'); // ✅ correct route name
    } elseif ($user->role === 'employer') {
        return redirect()->route('portal.dashboard'); // ✅ correct route for employer
    } elseif ($user->role === 'candidate') {
        return redirect()->route('portal.dashboard'); // ✅ correct route for candidate
    }

    return redirect()->route('portal.home'); // fallback for guests or others
}
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
