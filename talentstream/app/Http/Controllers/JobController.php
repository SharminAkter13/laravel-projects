<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Category;
use App\Models\JobLocation;
use App\Models\JobType;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /* ============================
        LIST ALL JOBS (index page)
       ============================ */
    public function index()
    {
        $jobs = Job::with(['category', 'jobLocation', 'jobType'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('pages.jobs.index', compact('jobs'));
    }

    /* ============================
        SHOW SINGLE JOB (details)
       ============================ */
    public function show($id)
    {
        $job = Job::with([
            'category',
            'jobLocation',
            'jobType'
        ])->findOrFail($id);

        /* RELATED JOBS (same category, excluding itself) */
        $relatedJobs = Job::with(['category', 'jobLocation'])
            ->where('category_id', $job->category_id)
            ->where('id', '!=', $job->id)
            ->limit(5)
            ->get();

        /* FEATURED JOBS */
        $featuredJobs = Job::with(['category', 'jobLocation'])
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        /* JOB GALLERY (random jobs) */
        $galleryJobs = Job::with(['category', 'jobLocation'])
            ->inRandomOrder()
            ->limit(6)
            ->get();

        return view('jobs.show', compact(
            'job',
            'relatedJobs',
            'featuredJobs',
            'galleryJobs'
        ));
    }

    /* ============================
        CREATE JOB FORM
       ============================ */
    public function create()
    {
        return view('pages.jobs.create', [
            'categories' => Category::all(),
            'locations' => JobLocation::all(),
            'types' => JobType::all(),
        ]);
    }

    /* ============================
        SAVE NEW JOB
       ============================ */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'job_location_id' => 'required',
            'job_type_id' => 'required',
            'description' => 'required',
        ]);

        Job::create([
            'user_email' => auth()->user()->email,
            'employer_id' => auth()->id(),
            'title' => $request->title,
            'category_id' => $request->category_id,
            'job_location_id' => $request->job_location_id,
            'job_type_id' => $request->job_type_id,
            'tags' => $request->tags,
            'description' => $request->description,
            'application_email' => $request->application_email,
            'application_url' => $request->application_url,
            'closing_date' => $request->closing_date,
            'company_name' => $request->company_name,
            'website' => $request->website,
            'tagline' => $request->tagline,
            'cover_image' => $request->cover_image,
            'status' => 'active',
        ]);

        return redirect()->route('jobs.index')
            ->with('success', 'Job added successfully');
    }

    /* ============================
        EDIT JOB
       ============================ */
    public function edit($id)
    {
        $job = Job::findOrFail($id);

        return view('pages.jobs.edit', [
            'job' => $job,
            'categories' => Category::all(),
            'locations' => JobLocation::all(),
            'types' => JobType::all(),
        ]);
    }

    /* ============================
        UPDATE JOB
       ============================ */
    public function update(Request $request, $id)
    {
        $job = Job::findOrFail($id);

        $job->update($request->all());

        return redirect()->route('jobs.index')
            ->with('success', 'Job updated successfully');
    }

    /* ============================
        DELETE JOB
       ============================ */
    public function destroy($id)
    {
        Job::findOrFail($id)->delete();

        return redirect()->route('jobs.index')
            ->with('success', 'Job deleted successfully');
    }
}
