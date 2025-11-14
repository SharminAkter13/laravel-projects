<?php

namespace App\Http\Controllers;

use App\Models\EmployerPackage;
use App\Models\Employer;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- **REQUIRED: Import Auth Facade**
class EmployerPackageController extends Controller
{
    public function index()
    {
        $employerPackages = EmployerPackage::with(['employer', 'package'])->latest()->paginate(10);
        return view('pages.employer_packages.index', compact('employerPackages'));
    }



    public function create()
    {
        $loggedInEmployer = Auth::guard('employer')->user();
        
        $packages = Package::select('id', 'name', 'duration_days')
                           ->where('status', 'active') 
                           ->get();

        $employers = Employer::all(); 

        return view('pages.employer_packages.create', [
            'packages' => $packages,
            'employers' => $employers, 
            'loggedInEmployer' => $loggedInEmployer, 
        ]);
    }  
    
    public function store(Request $request)
    {
        $request->validate([
            'employer_id' => 'required|exists:employers,id',
            'package_id' => 'required|exists:packages,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'nullable|string|max:50',
        ]);

        EmployerPackage::create($request->all());

        return redirect()->route('employer_packages.index')->with('success', 'Employer package added successfully.');
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
            'status' => 'nullable|string|max:50',
        ]);

        $employerPackage->update($request->all());

        return redirect()->route('employer_packages.index')->with('success', 'Employer package updated successfully.');
    }

    public function destroy(EmployerPackage $employerPackage)
    {
        $employerPackage->delete();
        return redirect()->route('employer_packages.index')->with('success', 'Employer package deleted successfully.');
    }
}
