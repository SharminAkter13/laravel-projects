<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;


class CandidateDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $candidateId = $user->id;

        $applications = Application::with('job.employer')
            ->where('candidate_id', $user->id)
            ->latest()
            ->get();

        $totalApplications = $applications->count();
        $totalInterviews = $applications->where('status', 'interview')->count();
        $totalOffers = $applications->where('status', 'accepted')->count();

        return view('candidate_dashboard', compact(
            'applications', 
            'totalApplications', 
            'totalInterviews', 
            'totalOffers'
        ));
    }
}
