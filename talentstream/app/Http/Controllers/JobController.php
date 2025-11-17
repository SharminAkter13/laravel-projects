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
        $job = Job::with(['category', 'jobLocation', 'jobType'])->findOrFail($id);

        $relatedJobs = Job::with(['category', 'jobLocation'])
            ->where('category_id', $job->category_id)
            ->where('id', '!=', $job->id)
            ->limit(5)
            ->get();

        $featuredJobs = Job::with(['category', 'jobLocation'])
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

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
        $user = auth()->user();
        $company = $user->company ?? null; // Assuming User hasOne Company

        return view('pages.jobs.create', [
            'categories' => Category::all(),
            'locations'  => JobLocation::all(),
            'types'      => JobType::all(),
            'company'    => $company,
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

        $user = auth()->user();
        $company = $user->company ?? null;

        Job::create([
            'user_email'       => $user->email,
            'employer_id'      => $user->id,
            'company_id'       => $company->id ?? null,
            'company_name'     => $company->name ?? $request->company_name,
            'website'          => $company->website ?? $request->website,
            'title'            => $request->title,
            'category_id'      => $request->category_id,
            'job_location_id'  => $request->job_location_id,
            'job_type_id'      => $request->job_type_id,
            'tags'             => $request->tags,
            'description'      => $request->description,
            'application_email'=> $request->application_email,
            'application_url'  => $request->application_url,
            'closing_date'     => $request->closing_date,
            'tagline'          => $request->tagline,
            'cover_image'      => $request->cover_image,
            'status'           => $request->status ?? 'active',
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
        $user = auth()->user();
        $company = $user->company ?? null;

        return view('pages.jobs.edit', [
            'job'        => $job,
            'categories' => Category::all(),
            'locations'  => JobLocation::all(),
            'types'      => JobType::all(),
            'company'    => $company,
        ]);
    }

    /* ============================
       UPDATE JOB
       ============================ */
    public function update(Request $request, $id)
    {
        $job = Job::findOrFail($id);

        // Prevent overwriting company info accidentally
        $user = auth()->user();
        $company = $user->company ?? null;

        $job->update([
            'title'            => $request->title,
            'category_id'      => $request->category_id,
            'job_location_id'  => $request->job_location_id,
            'job_type_id'      => $request->job_type_id,
            'tags'             => $request->tags,
            'description'      => $request->description,
            'application_email'=> $request->application_email,
            'application_url'  => $request->application_url,
            'closing_date'     => $request->closing_date,
            'tagline'          => $request->tagline,
            'cover_image'      => $request->cover_image,
            'status'           => $request->status ?? 'active',
            'company_name'     => $company->name ?? $request->company_name,
            'website'          => $company->website ?? $request->website,
        ]);

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
