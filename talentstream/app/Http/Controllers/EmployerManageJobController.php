<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class EmployerManageJobController extends Controller
{
    public function index()
    {
        $jobs = Job::withCount('applications')
            ->where('employer_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('portal_pages.employers.manage-jobs', compact('jobs'));
    }

    // Optional: view all applications for a specific job
    public function viewApplications($jobId)
    {
        $job = Job::with(['applications.candidate'])
            ->where('employer_id', auth()->id())
            ->findOrFail($jobId);

        return view('portal_pages.employers.manage_job_application', compact('job'));
    }
}
