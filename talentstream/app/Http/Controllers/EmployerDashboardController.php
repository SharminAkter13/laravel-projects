<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use Illuminate\Support\Facades\DB;
class EmployerDashboardController extends Controller
{
public function index()
{
    $user = Auth::user();
    $employerId = $user->id;

    // Get all jobs with applications count and viewers count
    $jobs = Job::where('employer_id', $employerId)
        ->withCount(['applications', 'viewers'])
        ->orderBy('created_at', 'desc')
        ->get();

    $totalJobsPosted = $jobs->count();
    $totalJobViews = $jobs->sum('viewers_count');

    $newApplicationsCount = Application::whereIn('job_id', $jobs->pluck('id'))
        ->where('status', 'new')
        ->count();

        $totalCandidatesApplied = Application::whereIn('job_id', $jobs->pluck('id'))->count();


    $applicationChangeType = 'new';
    
    $monthlyAppData = DB::table('applications')
        ->join('jobs', 'applications.job_id', '=', 'jobs.id')
        ->selectRaw('MONTH(applications.created_at) as month, COUNT(*) as count')
        ->where('jobs.employer_id', $employerId)
        ->groupBy('month')
        ->get();

     $weeklyAppData = DB::table('applications')
    ->join('jobs', 'applications.job_id', '=', 'jobs.id')
    ->selectRaw('WEEK(applications.created_at) as week, COUNT(*) as count')
    ->where('jobs.employer_id', $employerId)
    ->groupBy('week')
    ->get();

    $jobPerformance = $jobs->map(function($job) {
    return [
        'job' => $job,
        'applications_count' => $job->applications()->count(),
        'viewers_count' => $job->views()->count(),
    ];
});

   return view('employer_dashboard', compact(
    'jobs',
    'totalJobsPosted',
    'newApplicationsCount',
    'applicationChangeType',
    'totalJobViews',
    'totalCandidatesApplied',
    'monthlyAppData',
    'weeklyAppData',
    'jobPerformance' 
));

}
}
