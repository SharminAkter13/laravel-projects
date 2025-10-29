<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


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
        'resume' => 'nullable|string',
        'phone'  => 'nullable|string',
        'address'=> 'nullable|string',
    ]);

    $user = Auth::user(); // get logged-in user

    // Check if user already has candidate profile
    if ($user->candidate) {
        return redirect()->route('candidates.index')->with('error', 'Candidate profile already exists!');
    }

    // Create candidate profile
    $user->candidate()->create($request->only(['resume', 'phone', 'address']));

    return redirect()->route('candidates.index')->with('success', 'Candidate profile created successfully!');
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
