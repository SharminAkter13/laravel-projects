<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::latest()->paginate(10);
        return view('pages.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('pages.packages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'duration_days' => 'nullable|integer',
            'features' => 'nullable|string',
        ]);

        Package::create($request->all());

        return redirect()->route('packages.index')->with('success', 'Package created successfully.');
    }

    public function edit(Package $package)
    {
        return view('pages.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'duration_days' => 'nullable|integer',
            'features' => 'nullable|string',
        ]);

        $package->update($request->all());

        return redirect()->route('packages.index')->with('success', 'Package updated successfully.');
    }

    public function destroy(Package $package)
    {
        $package->delete();

        return redirect()->route('packages.index')->with('success', 'Package deleted successfully.');
    }
}
