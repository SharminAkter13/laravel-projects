<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployerController extends Controller
{
    public function index()
    {
        $employers = Employer::with('user')->get();
        return view('pages.employers.index', compact('employers'));
    }

    public function create()
    {
        return view('pages.employers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'company_name' => 'nullable|string',
            'website' => 'nullable|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        // Create User with employer role
        $role = Role::where('name', 'employer')->first();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role->id,
        ]);

        // Create Employer profile
        $user->employer()->create($request->only(['company_name','website','phone','address']));

        return redirect()->route('employers.index')->with('success', 'Employer created successfully!');
    }

    public function edit(Employer $employer)
    {
        return view('pages.employers.edit', compact('employer'));
    }

    public function update(Request $request, Employer $employer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$employer->user_id,
            'company_name' => 'nullable|string',
            'website' => 'nullable|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        // Update User
        $employer->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Update Employer profile
        $employer->update($request->only(['company_name','website','phone','address']));

        return redirect()->route('employers.index')->with('success', 'Employer updated successfully!');
    }

    public function destroy(Employer $employer)
    {
        $employer->user()->delete(); // deletes employer profile too
        return redirect()->route('employers.index')->with('success', 'Employer deleted successfully!');
    }
}
