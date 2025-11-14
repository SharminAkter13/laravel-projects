<?php

namespace App\Http\Controllers;

use App\Models\EmployerPackage;
use App\Models\Employer;
use App\Models\Package;
use Illuminate\Http\Request;

class EmployerPackageController extends Controller
{
    public function index()
    {
        $employerPackages = EmployerPackage::with(['employer', 'package'])
            ->latest()
            ->paginate(10);

        return view('pages.employer_packages.index', compact('employerPackages'));
    }

    public function create()
    {
        // Logged-in user (default guard)
        $loggedInUser = auth()->user();

        // Get employer record for the logged-in user
        $employer = Employer::where('user_id', $loggedInUser->id)->first();

        // Active packages list
       
$packages = Package::select('id', 'name', 'duration_days')->get();

        return view('pages.employer_packages.create', [
            'packages' => $packages,
            'employer' => $employer,
            'loggedInUser' => $loggedInUser,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'employer_id' => 'required|exists:employers,id',
            'package_id' => 'required|exists:packages,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        EmployerPackage::create($request->only([
            'employer_id',
            'package_id',
            'start_date',
            'end_date',
        ]));

        return redirect()
            ->route('employer_packages.index')
            ->with('success', 'Employer package added successfully.');
    }

    public function edit(EmployerPackage $employerPackage)
    {
        $employers = Employer::all();
        $packages = Package::all();

        return view('pages.employer_packages.edit', compact('employerPackage', 'employers', 'packages'));
    }

    public function update(Request $request, EmployerPackage $employerPackage)
    {
        $request->validate([
            'employer_id' => 'required|exists:employers,id',
            'package_id' => 'required|exists:packages,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $employerPackage->update($request->only([
            'employer_id',
            'package_id',
            'start_date',
            'end_date',
        ]));

        return redirect()
            ->route('employer_packages.index')
            ->with('success', 'Employer package updated successfully.');
    }

    public function destroy(EmployerPackage $employerPackage)
    {
        $employerPackage->delete();

        return redirect()
            ->route('employer_packages.index')
            ->with('success', 'Employer package deleted successfully.');
    }
}
