<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;


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
      // Check if user is approved
    if ($user->status !== 'active' && $user->role?->name !== 'admin') {
    Auth::logout();
    return redirect()->route('login')->with('error', 'Your account is pending approval by admin.');
}

    $roleName = $user->role?->name;

    return match ($roleName) {
        'admin' => redirect()->route('admin.dashboard'),
        'candidate' => redirect()->route('candidate.dashboard'),
        'employer' => redirect()->route('employer.dashboard'),
        default => redirect()->route('portal.home'),
    };
}
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
