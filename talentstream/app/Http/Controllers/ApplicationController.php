<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    // Display applications (admin sees all, candidate sees own)
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $applications = Application::with(['job', 'candidate'])->latest()->paginate(10);
        } else {
            // Use candidate_id from candidate table (not user id directly)
            $candidate = Auth::user()->candidate;

            if (!$candidate) {
                return back()->with('error', 'No candidate profile found.');
            }

            $applications = Application::with(['job', 'candidate'])
                ->where('candidate_id', $candidate->id)
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
        $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'resume' => 'required|mimes:pdf,doc,docx|max:2048',
            'cover_letter' => 'nullable|string',
        ]);

        // Get candidate record
        $candidate = Auth::user()->candidate;

        if (!$candidate) {
            return back()->with('error', 'Only candidates can apply for jobs.');
        }

        // Prevent duplicate applications
        $alreadyApplied = Application::where('job_id', $request->job_id)
            ->where('candidate_id', $candidate->id)
            ->exists();

        if ($alreadyApplied) {
            return back()->with('error', 'You have already applied to this job.');
        }

        // Handle resume upload
        $resumePath = $request->file('resume')->store('resumes', 'public');

        // Create the application
        Application::create([
            'job_id' => $request->job_id,
            'candidate_id' => $candidate->id,
            'applied_date' => now(),
            'resume' => $resumePath,
            'cover_letter' => $request->cover_letter,
            'status' => 'active',
        ]);

        return redirect()
            ->route('jobs.show', $request->job_id)
            ->with('success', 'Your application has been submitted successfully!');
    }

    // Show details of a single application
    public function show($id)
    {
        $application = Application::with(['job', 'candidate'])->findOrFail($id);

        // Restrict candidates to see only their own applications
        if (Auth::user()->role === 'candidate' && $application->candidate_id !== Auth::user()->candidate->id) {
            abort(403, 'Unauthorized access.');
        }

        return view('pages.applications.show', compact('application'));
    }
}
