<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CandidateController extends Controller
{
    public function index()
    {
        $candidates = Candidate::with('user')->get();
        return view('pages.candidates.index', compact('candidates'));
    }

    public function create()
    {
        return view('pages.candidates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'resume' => 'nullable|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        // Create User with candidate role
        $role = Role::where('name', 'candidate')->first();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role->id,
        ]);

        // Create Candidate profile
        $user->candidate()->create($request->only(['resume','phone','address']));

        return redirect()->route('candidates.index')->with('success', 'Candidate created successfully!');
    }

    public function edit(Candidate $candidate)
    {
        return view('pages.candidates.edit', compact('candidate'));
    }

    public function update(Request $request, Candidate $candidate)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$candidate->user_id,
            'resume' => 'nullable|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        // Update User
        $candidate->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Update Candidate profile
        $candidate->update($request->only(['resume','phone','address']));

        return redirect()->route('candidates.index')->with('success', 'Candidate updated successfully!');
    }

    public function destroy(Candidate $candidate)
    {
        $candidate->user()->delete(); // deletes candidate as well due to cascade
        return redirect()->route('candidates.index')->with('success', 'Candidate deleted successfully!');
    }
}
