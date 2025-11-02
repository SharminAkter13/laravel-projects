<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

class PortalJobController extends Controller
{
    // Show form
    public function create() {
        return view('portal.post-job'); // Your blade file
    }

    // Store job
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'application_email' => 'required|email',
            'closing_date' => 'nullable|date',
            'company_name' => 'required|string|max:255',
            'website' => 'nullable|url',
            'cover_img_file' => 'nullable|image|max:2048',
        ]);

        $job = new Job();
        $job->employer_id = Auth::id(); // Employer ID
        $job->title = $request->title;
        $job->location = $request->location;
        $job->category = $request->category;
        $job->tags = $request->tags;
        $job->description = $request->description;
        $job->application_email = $request->application_email;
        $job->closing_date = $request->closing_date;
        $job->company_name = $request->company_name;
        $job->website = $request->website;

        // Upload cover image
        if ($request->hasFile('cover_img_file')) {
            $file = $request->file('cover_img_file');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/job_covers'), $filename);
            $job->cover_image = $filename;
        }

        $job->save();

        return redirect()->route('portal.job.create')->with('success', 'Job posted successfully!');
    }
}
