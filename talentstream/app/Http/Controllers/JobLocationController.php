<?php

namespace App\Http\Controllers;

use App\Models\JobLocation;
use Illuminate\Http\Request;

class JobLocationController extends Controller
{
    // Require authentication
    public function __construct()
    {
        $this->middleware('auth');
    }

    // List all job locations
    public function index()
    {
        $locations = JobLocation::latest()->paginate(10);
        return view('pages.job_locations.index', compact('locations'));
    }

    // Show create form
    public function create()
    {
        return view('pages.job_locations.create');
    }

    // Store new location
    public function store(Request $request)
    {
        $request->validate([
            'country' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'address' => 'nullable|string',
            'postal_code' => 'nullable|string|max:20',
        ]);

        JobLocation::create($request->all());

        return redirect()->route('job_locations.index')->with('success', 'Job location added successfully.');
    }

    // Show edit form
    public function edit(JobLocation $jobLocation)
    {
        return view('pages.job_locations.edit', compact('jobLocation'));
    }

    // Update existing location
    public function update(Request $request, JobLocation $jobLocation)
    {
        $request->validate([
            'country' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'address' => 'nullable|string',
            'postal_code' => 'nullable|string|max:20',
        ]);

        $jobLocation->update($request->all());

        return redirect()->route('job_locations.index')->with('success', 'Job location updated successfully.');
    }

    // Delete location
    public function destroy(JobLocation $jobLocation)
    {
        $jobLocation->delete();
        return redirect()->route('job_locations.index')->with('success', 'Job location deleted successfully.');
    }
}
