<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function index()
    {
        $profiles = Profile::all(); // You can paginate if needed
        return view('profile.index', compact('profiles'));
    }

    public function show()
    {
        $profile = Auth::user()->profile;
        return view('pages.profile.show', compact('profile'));
    }

    public function edit()
    {
        $profile = Auth::user()->profile;
        return view('pages.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|max:50',
            'email' => 'required|email',
            'first_name' => 'nullable|string|max:50',
            'last_name' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'about_me' => 'nullable|string',
            'age' => 'nullable|integer',
            'job_title' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:100',
            'education' => 'nullable|string|max:150',
        ]);

        $profile = Auth::user()->profile;
        $profile->update($data);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
