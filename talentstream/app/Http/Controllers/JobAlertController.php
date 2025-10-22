<?php

namespace App\Http\Controllers;

use App\Models\JobAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobAlertController extends Controller
{
     use AuthorizesRequests;
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $jobAlerts = JobAlert::where('user_id', Auth::id())
                             ->orderBy('created_at', 'desc')
                             ->paginate(10);

        return view('pages.job_alerts.index', compact('jobAlerts'));
    }

    public function create()
    {
        return view('job_alerts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'         => 'required|string|max:255',
            'keywords'      => 'nullable|string|max:255',
            'location'      => 'nullable|string|max:255',
            'contract_type' => 'required|string|in:full‑time,part‑time',
            'frequency'     => 'required|string|in:daily,weekly,monthly',
        ]);

        $data['user_id'] = Auth::id();

        JobAlert::create($data);

        return redirect()->route('job_alerts.index')
                         ->with('success', 'Job alert created successfully.');
    }

    public function edit(JobAlert $jobAlert)
    {
        // Ensure the user owns this alert
        $this->authorize('update', $jobAlert);

        return view('job_alerts.edit', compact('jobAlert'));
    }

    public function update(Request $request, JobAlert $jobAlert)
    {
        $this->authorize('update', $jobAlert);

        $data = $request->validate([
            'title'         => 'required|string|max:255',
            'keywords'      => 'nullable|string|max:255',
            'location'      => 'nullable|string|max:255',
            'contract_type' => 'required|string|in:full‑time,part‑time',
            'frequency'     => 'required|string|in:daily,weekly,monthly',
        ]);

        $jobAlert->update($data);

        return redirect()->route('job_alerts.index')
                         ->with('success', 'Job alert updated successfully.');
    }

    public function destroy(JobAlert $jobAlert)
    {
        $this->authorize('delete', $jobAlert);

        $jobAlert->delete();

        return redirect()->route('job_alerts.index')
                         ->with('success', 'Job alert deleted.');
    }
}
