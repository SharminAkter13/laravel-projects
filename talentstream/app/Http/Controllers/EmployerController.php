<?php
namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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

        $role = Role::where('name', 'employer')->first();

        // Create User with status pending
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role->id,
            'status' => 'pending', // must be approved by admin
        ]);

        // Employer profile will be created only after admin approval
        return redirect()->route('employers.index')->with('success', 'Employer created successfully. Awaiting admin approval.');
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
        $employer->user()->delete(); // deletes employer profile automatically
        return redirect()->route('employers.index')->with('success', 'Employer deleted successfully!');
    }
}
