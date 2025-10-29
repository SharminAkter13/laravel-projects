<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobBookmark;
use Illuminate\Support\Facades\Auth;

class JobBookmarkController extends Controller
{
    // Show all bookmarks of logged-in candidate
    public function index()
    {
        $user = Auth::user();

        if (!$user->candidate) {
            return abort(403, 'Only candidates can access bookmarks.');
        }

        $bookmarks = JobBookmark::with('job')
            ->where('candidate_id', $user->candidate->id)
            ->latest()
            ->get();

        return view('bookmarks.index', compact('bookmarks'));
    }

    // Store a new bookmark
    public function store(Request $request, $jobId)
    {
        $user = Auth::user();

        if (!$user->candidate) {
            return back()->with('error', 'Only candidates can bookmark jobs.');
        }

        $candidateId = $user->candidate->id;

        $existing = JobBookmark::where('candidate_id', $candidateId)
            ->where('job_id', $jobId)
            ->first();

        if ($existing) {
            return back()->with('info', 'Job already bookmarked.');
        }

        JobBookmark::create([
            'candidate_id' => $candidateId,
            'job_id' => $jobId,
            'saved_date' => now(),
        ]);

        return back()->with('success', 'Job bookmarked successfully!');
    }

    // Remove bookmark
    public function destroy($id)
    {
        $bookmark = JobBookmark::findOrFail($id);
        $bookmark->delete();

        return back()->with('success', 'Bookmark removed.');
    }
}
