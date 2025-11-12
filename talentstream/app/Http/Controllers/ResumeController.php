<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{
    // 🧾 Show all resumes
    public function index()
    {
        $resumes = Resume::with(['educations', 'experiences', 'skills'])->get();
        return view('pages.resumes.resume', compact('resumes'));
    }

    // ➕ Show create form
    public function create()
    {
        return view('pages.resumes.create-resume');
    }

    // 💾 Store resume + related data
public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'profession_title' => 'nullable|string|max:255',
        'location' => 'nullable|string|max:255',
        'web' => 'nullable|string|max:255',
        'pre_hour' => 'nullable|string|max:255',
        'age' => 'nullable|integer',
        'cover_image' => 'nullable|image|mimes:jpg,jpeg,png',
    ]);

    // Upload cover image
    if ($request->hasFile('cover_image')) {
        $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
    }

    // Create Resume
    $resume = Resume::create($data);

    // Education entries
    if ($request->has('educations')) {
        foreach ($request->educations as $edu) {
            $eduData = [
                'resume_id' => $resume->id,
                'degree' => $edu['degree'] ?? null,
                'field_of_study' => $edu['field_of_study'] ?? null,
                'school' => $edu['school'] ?? null,
                'edu_from' => $edu['edu_from'] ?? null,
                'edu_to' => $edu['edu_to'] ?? null,
                'edu_description' => $edu['edu_description'] ?? null,
            ];
            if (isset($edu['edu_logo']) && $edu['edu_logo'] instanceof \Illuminate\Http\UploadedFile) {
                $eduData['edu_logo'] = $edu['edu_logo']->store('edu_logos', 'public');
            }
            Education::create($eduData);
        }
    }

    // Experience entries
    if ($request->has('experiences')) {
        foreach ($request->experiences as $exp) {
            $expData = [
                'resume_id' => $resume->id,
                'company_name' => $exp['company_name'] ?? null,
                'title' => $exp['title'] ?? null,
                'exp_from' => $exp['exp_from'] ?? null,
                'exp_to' => $exp['exp_to'] ?? null,
                'exp_description' => $exp['exp_description'] ?? null,
            ];
            if (isset($exp['exp_logo']) && $exp['exp_logo'] instanceof \Illuminate\Http\UploadedFile) {
                $expData['exp_logo'] = $exp['exp_logo']->store('exp_logos', 'public');
            }
            Experience::create($expData);
        }
    }

    // Skills entries
    if ($request->has('skills')) {
        foreach ($request->skills as $skill) {
            Skill::create([
                'resume_id' => $resume->id,
                'skill_name' => $skill['skill_name'] ?? null,
                'skill_percent' => $skill['skill_percent'] ?? null,
            ]);
        }
    }

    return redirect()->route('resumes.resume')->with('success', 'Resume created successfully!');
}

    //  Show a single resume
    public function show($id)
    {
        $resume = Resume::with(['educations', 'experiences', 'skills'])->findOrFail($id);
        return view('pages.resumes.show-resume', compact('resume'));
    }

    // ✏️ Edit form
    public function edit($id)
    {
        $resume = Resume::with(['educations', 'experiences', 'skills'])->findOrFail($id);
        return view('pages.resumes.edit-resume', compact('resume'));
    }

    // 🔁 Update resume + relations
    public function update(Request $request, $id)
    {
        $resume = Resume::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'profession_title' => 'nullable|string|max:150',
            'location' => 'nullable|string|max:150',
            'web' => 'nullable|string|max:150',
            'pre_hour' => 'nullable|string|max:50',
            'age' => 'nullable|integer',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // ✅ Replace old image if uploaded
        if ($request->hasFile('cover_image')) {
            if ($resume->cover_image && Storage::disk('public')->exists($resume->cover_image)) {
                Storage::disk('public')->delete($resume->cover_image);
            }
            $path = $request->file('cover_image')->store('resumes', 'public');
            $validated['cover_image'] = $path;
        }

        $resume->update($validated);

        // ✅ Delete old related data
        $resume->educations()->delete();
        $resume->experiences()->delete();
        $resume->skills()->delete();

        // ✅ Recreate updated relations
        if ($request->educations) {
            foreach ($request->educations as $edu) {
                if (!empty($edu['degree'])) {
                    $resume->educations()->create($edu);
                }
            }
        }

        if ($request->experiences) {
            foreach ($request->experiences as $exp) {
                if (!empty($exp['company_name'])) {
                    $resume->experiences()->create($exp);
                }
            }
        }

        if ($request->skills) {
            foreach ($request->skills as $skill) {
                if (!empty($skill['skill_name'])) {
                    $resume->skills()->create($skill);
                }
            }
        }

        return Redirect()->route('resumes.resume')->with('success', 'Resume updated successfully!');
    }

    // 🗑️ Delete resume and related data
    public function destroy($id)
    {
        $resume = Resume::with(['educations', 'experiences', 'skills'])->findOrFail($id);

        if ($resume->cover_image && Storage::disk('public')->exists($resume->cover_image)) {
            Storage::disk('public')->delete($resume->cover_image);
        }

        $resume->educations()->delete();
        $resume->experiences()->delete();
        $resume->skills()->delete();
        $resume->delete();

        return Redirect()->route('resumes.resume')->with('success', 'Resume deleted successfully.');
    }
}
