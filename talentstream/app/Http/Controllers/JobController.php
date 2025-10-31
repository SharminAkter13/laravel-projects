<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('category')->get();
        return view('pages.jobs.index', compact('jobs'));
    }

    public function show($id)
{
    $job = Job::with('category')->findOrFail($id);
    return view('pages.jobs.show', compact('job'));
}


    public function create()
    {
        $categories = Category::all();
        return view('pages.jobs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_email' => 'required|email',
            'title' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|string',
            'description' => 'nullable|string',
            'application_email' => 'nullable|email',
            'application_url' => 'nullable|url',
            'closing_date' => 'nullable|date',
            'company_name' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'nullable|string|in:active,inactive',
        ]);

        $data = $request->all();

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('job_covers', 'public');
        }

        Job::create($data);
        return redirect()->route('jobs.index')->with('success', 'Job created successfully.');
    }

    public function edit(Job $job)
    {
        $categories = Category::all();
        return view('pages.jobs.edit', compact('job', 'categories'));
    }

    public function update(Request $request, Job $job)
    {
        $request->validate([
            'user_email' => 'required|email',
            'title' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|string',
            'description' => 'nullable|string',
            'application_email' => 'nullable|email',
            'application_url' => 'nullable|url',
            'closing_date' => 'nullable|date',
            'company_name' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'nullable|string|in:active,inactive',
        ]);

        $data = $request->all();

        if ($request->hasFile('cover_image')) {
            if ($job->cover_image && Storage::disk('public')->exists($job->cover_image)) {
                Storage::disk('public')->delete($job->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('job_covers', 'public');
        }

        $job->update($data);
        return redirect()->route('jobs.index')->with('success', 'Job updated successfully.');
    }

    public function destroy(Job $job)
    {
        if ($job->cover_image && Storage::disk('public')->exists($job->cover_image)) {
            Storage::disk('public')->delete($job->cover_image);
        }
        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully.');
    }
}
