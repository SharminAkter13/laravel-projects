<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResumePortalController extends Controller
{
    public function create()
    {
        return view('portal_pages.candidate.add_resume');
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

return redirect()->back()->with('success', 'Resume has Successfully Created.');
}
}
