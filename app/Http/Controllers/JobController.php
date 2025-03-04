<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::all();
        return view('admin.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('admin.jobs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,pdf,doc,docx|max:2048',
            'deadline' => 'required|date',
        ]);
    
        $filePath = null;
    
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('jobs'), $fileName);
            $filePath = 'jobs/' . $fileName;
        }
    
        Job::create([
            'title' => $request->title,
            'description' => $request->description,
            'file' => $filePath,
            'deadline' => $request->deadline,
            'publish_date' => now(),
        ]);
    
        return redirect()->route('jobs.index')->with('success', 'Job created successfully.');
    }

    public function show(Job $job)
    {
        return view('admin.jobs.show', compact('job'));
    }

    public function edit(Job $job)
    {
        return view('admin.jobs.edit', compact('job'));
    }

    public function update(Request $request, $id)
    {
        $job = Job::findOrFail($id);
    
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,pdf,doc,docx|max:2048',
            'deadline' => 'required|date',
        ]);
    
        // Handle file update
        if ($request->hasFile('file')) {
            // Delete old file if it exists
            if ($job->file && File::exists(public_path($job->file))) {
                File::delete(public_path($job->file));
            }
    
            // Upload new file
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('jobs'), $fileName);
            $job->file = 'jobs/' . $fileName;
        }
    
        // Update other fields
        $job->title = $request->title;
        $job->description = $request->description;
        $job->deadline = $request->deadline;
        $job->save();
    
        return redirect()->route('jobs.index')->with('success', 'Job updated successfully.');
    }
    

    public function destroy($id)
    {
        $job = Job::findOrFail($id);
    
        // Delete file from storage
        if ($job->file && File::exists(public_path($job->file))) {
            File::delete(public_path($job->file));
        }
    
        // Delete record from database
        $job->delete();
    
        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully.');
    }
}
