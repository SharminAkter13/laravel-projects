<?php

namespace App\Http\Controllers;

use App\Models\EmployerPackage;
use App\Models\Employer;
use App\Models\Package;
use Illuminate\Http\Request;

class EmployerPackageController extends Controller
{
    /**
     * Show employer packages list
     */
    public function index()
    {
        $employerPackages = EmployerPackage::with(['employer.company', 'package'])
            ->latest()
            ->paginate(10);

        return view('pages.employer_packages.index', compact('employerPackages'));
    }

    /**
     * Create a new employer package
     */
    public function create()
    {
        // Logged-in user
        $loggedInUser = auth()->user();

        // Get employer record for logged-in user
        $employer = Employer::with('company')        // <- load company name
            ->where('user_id', $loggedInUser->id)
            ->first();

        // If admin logged in, load all employers
        $employers = Employer::with('company')->get();

        // Available packages
        $packages = Package::select('id', 'name', 'duration_days')->get();

        return view('pages.employer_packages.create', [
            'packages'   => $packages,
            'employer'   => $employer,      // logged-in employer (auto-fill)
            'employers'  => $employers,     // admin list
            'loggedInUser' => $loggedInUser,
        ]);
    }

    /**
     * Store employer package
     */
    public function store(Request $request)
    {
        $request->validate([
            'employer_id' => 'required|exists:employers,id',
            'package_id'  => 'required|exists:packages,id',
            'start_date'  => 'nullable|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
        ]);

        EmployerPackage::create([
            'employer_id' => $request->employer_id,
            'package_id'  => $request->package_id,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'status'      => 'active', // Default status (optional)
        ]);

        return redirect()
            ->route('employer_packages.index')
            ->with('success', 'Employer package added successfully.');
    }

    /**
     * Edit employer package
     */
    public function edit(EmployerPackage $employerPackage)
    {
        $employers = Employer::with('company')->get();
        $packages = Package::all();

        return view('pages.employer_packages.edit', compact('employerPackage', 'employers', 'packages'));
    }

    /**
     * Update employer package
     */
    public function update(Request $request, EmployerPackage $employerPackage)
    {
        $request->validate([
            'employer_id' => 'required|exists:employers,id',
            'package_id'  => 'required|exists:packages,id',
            'start_date'  => 'nullable|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
        ]);

        $employerPackage->update([
            'employer_id' => $request->employer_id,
            'package_id'  => $request->package_id,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
        ]);

        return redirect()
            ->route('employer_packages.index')
            ->with('success', 'Employer package updated successfully.');
    }

    /**
     * Delete employer package
     */
    public function destroy(EmployerPackage $employerPackage)
    {
        $employerPackage->delete();

        return redirect()
            ->route('employer_packages.index')
            ->with('success', 'Employer package deleted successfully.');
    }
}
