<?php

namespace App\Http\Controllers;

use App\Models\JobView;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobViewController extends Controller
{
    // Record a job view
    public function store(Job $job)
    {
        $user = Auth::user();

        JobView::updateOrCreate(
            [
                'job_id' => $job->id,
                'user_id' => $user->id,
            ],
            [
                'viewed_at' => now(),
            ]
        );

        return redirect()->route('jobs.show', $job->id);
    }

    // List all views (admin)
    public function index()
    {
        $views = JobView::with(['job', 'viewer'])->latest()->get();
        return view('job_views.index', compact('views'));
    }
}
