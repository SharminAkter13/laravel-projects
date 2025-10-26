<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request.
     */
    public function register(Request $request)
    {
        // Validate form data
        $this->validator($request->all())->validate();

        // Create user
        event(new Registered($user = $this->create($request->all())));

        // Redirect to login with success message
        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }

    /**
     * Validate registration data.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:candidate,employer'],
        ]);
    }

    /**
     * Create a new user instance.
     */
    protected function create(array $data)
    {
        // Map role name to role_id from your `roles` table
        $roleId = match ($data['role']) {
            'candidate' => 2, // e.g., 2 = Candidate
            'employer' => 3,  // e.g., 3 = Employer
            default => 2,     // fallback
        };

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $roleId, // ✅ correct column
        ]);
    }
}
