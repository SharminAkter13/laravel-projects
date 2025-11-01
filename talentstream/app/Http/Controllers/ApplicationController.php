<?php
namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    // Display all applications (admin can see all, candidate sees their own)
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $applications = Application::with(['job', 'candidate'])->latest()->paginate(10);
        } else {
            $applications = Application::with(['job', 'candidate'])
                ->where('candidate_id', Auth::id())
                ->latest()
                ->paginate(10);
        }

        return view('pages.applications.index', compact('applications'));
    }

    // Show the form to apply for a job
    public function create($jobId)
    {
        $job = Job::findOrFail($jobId);

        return view('pages.applications.create', compact('job'));
    }

    // Store a new application
public function store(Request $request)
{
    // Validate inputs
    $request->validate([
        'job_id' => 'required|exists:jobs,id',
        'resume_submitted' => 'required|date',
        'cover_letter' => 'nullable|string',
    ]);

    // Prevent duplicate applications
    $alreadyApplied = Application::where('job_id', $request->job_id)
        ->where('candidate_id', Auth::id())
        ->exists();

    if ($alreadyApplied) {
        return redirect()->back()->with('error', 'You have already applied to this job.');
    }

    // Create the application
    Application::create([
        'job_id' => $request->job_id,
        'candidate_id' => Auth::id(),
        'applied_date' => now(),
        'resume_submitted' => $request->resume_submitted,
        'cover_letter' => $request->cover_letter,
    ]);

    return redirect()->route('jobs.show', $request->job_id)
                     ->with('success', 'Application submitted successfully!');
}


    // Show details of a single application
    public function show($id)
    {
        $application = Application::with(['job', 'candidate'])->findOrFail($id);

        // Optional: restrict candidates to only see their own applications
        if (Auth::user()->role === 'candidate' && $application->candidate_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        return view('pages.applications.show', compact('application'));
    }
}
