<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Candidate;
use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // List all users
    public function index()
    {
        $users = User::all();
        return view('pages.users.index', compact('users'));
    }

    // Show create form
    public function create()
    {
        $roles = ['admin', 'candidate', 'employer']; // from enum
        return view('pages.users.create', compact('roles'));
    }

    // Store new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,candidate,employer',
        ]);

        // ✅ Only admin can create other admins
        if (Auth::check() && Auth::user()->role !== 'admin' && $request->role === 'admin') {
            abort(403, 'Unauthorized to create admin accounts.');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Auto create related model if needed
        if ($request->role === 'candidate') {
            $user->candidate()->create([
                'resume' => null,
                'phone' => null,
                'address' => null,
            ]);
        } elseif ($request->role === 'employer') {
            $user->employer()->create([
                'company_name' => null,
                'website' => null,
                'phone' => null,
                'address' => null,
            ]);
        }

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = ['admin', 'candidate', 'employer'];
        return view('pages.users.edit', compact('user', 'roles'));
    }

    // Update user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:6',
            'role' => 'required|in:admin,candidate,employer',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // Delete user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
