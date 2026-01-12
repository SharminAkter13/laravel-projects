<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Company;
use App\Models\Employer;
use App\Models\JobLocation;
use App\Models\JobType;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File; // Added for file management

class PortalJobController extends Controller
{
    // Show jobs posted by employer
    public function index()
    {
        $user = Auth::user();
        $employer = $user->employer()->first();

        if (!$employer) {
            return view('portal_pages.employers.manage_job', ['jobs' => collect([])]);
        }

        $jobs = Job::where('employer_id', $employer->id)
            ->latest()
            ->paginate(10);

        return view('portal_pages.employers.manage_job', compact('jobs'));
    }

    // Show form with company info + dropdown lists
    public function create()
    {
        $user = Auth::user();
        $employer = $user->employer; 
        $company = $employer->company ?? null; 

        $jobLocations = JobLocation::all();
        $jobTypes     = JobType::all();
        $categories   = Category::all();

        return view(
            'portal_pages.employers.add_job',
            compact('company', 'user', 'employer', 'jobLocations', 'jobTypes', 'categories')
        );
    }

    // Store job
    public function store(Request $request)
    {
        $request->validate([
            'title'             => 'required|string|max:255',
            'job_location_id'   => 'required|integer|exists:job_locations,id',
            'job_type_id'       => 'required|integer|exists:job_types,id',
            'category_id'       => 'required|integer|exists:categories,id',
            'description'       => 'required|string',
            'application_email' => 'nullable|email|max:255',
            'application_url'   => 'nullable|url|max:255',
            'closing_date'      => 'nullable|date',
            'cover_img_file'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tagline'           => 'nullable|string|max:255',
            'status'            => 'nullable|string',
        ]);

        $user = Auth::user();
        $employer = $user->employer()->first();

        if (!$employer) {
            return redirect()->back()->with('error', 'Employer profile not found.');
        }

        $company = $employer->company ?? null;

        $job = new Job();
        
        $job->user_email = $user->email;
        $job->employer_id = $employer->id;
        $job->company_name = $company->name ?? $request->company_name;
        $job->website = $company->website ?? $request->website;

        $job->title             = $request->title;
        $job->job_location_id   = $request->job_location_id;
        $job->job_type_id       = $request->job_type_id;
        $job->category_id       = $request->category_id;
        $job->tags              = $request->tags;
        $job->description       = $request->description;
        $job->application_email = $request->application_email;
        $job->application_url   = $request->application_url;
        $job->closing_date      = $request->closing_date;
        $job->tagline           = $request->tagline;
        $job->status            = $request->status ?? 'active';

        // --- FIXED IMAGE UPLOAD LOGIC ---
        if ($request->hasFile('cover_img_file')) {
            $file = $request->file('cover_img_file');
            
            // Generate unique filename
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Define the path: public/uploads/jobs
            $uploadPath = public_path('uploads/jobs');

            // Create folder if it doesn't exist
            if (!File::isDirectory($uploadPath)) {
                File::makeDirectory($uploadPath, 0777, true, true);
            }

            // Move the file
            $file->move($uploadPath, $filename);
            
            // Save ONLY the filename to the database
            $job->cover_image = $filename;
        }

        $job->save();

        return redirect()->route('portal.job.create')
            ->with('success', 'Job posted successfully!');
    }
}