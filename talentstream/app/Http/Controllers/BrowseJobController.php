<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BrowseJobController extends Controller
{
     public function index()
    {
        $jobs = Job::latest()->paginate(10); // paginate jobs
        $categories = Category::all();
        $locations = Job::select('location')->distinct()->get();
        $types = Job::select('type')->distinct()->get();

        return view('portal_pages.candidates.browse_jobs', compact('jobs', 'categories', 'locations', 'types'));
    }
}
