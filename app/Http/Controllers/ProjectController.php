<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'client' => 'required',
            'leader_name' => 'required',
            'leader_email' => 'required|email',
            'leader_photo' => 'required|image',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $path = $request->file('leader_photo')->store('leaders','public');

        Project::create([
            'title' => $request->title,
            'client' => $request->client,
            'leader_name' => $request->leader_name,
            'leader_email' => $request->leader_email,
            'leader_photo' => $path,
            'start_date' =>  $request->start_date,
            'end_date' => $request->end_date,
        ]);
        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
        'title' => 'required',
        'client' => 'required',
        'leader_name' => 'required',
        'leader_email' => 'required|email',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'leader_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->only(['title', 'client', 'leader_name', 'leader_email', 'start_date', 'end_date']);

    if ($request->hasFile('leader_photo')) {
        $path = $request->file('leader_photo')->store('leaders', 'public');
        $data['leader_photo'] = $path;
    }

    $project->update($data);

    return redirect()->route('projects.index')->with('success', 'Project update successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
      if ($project->leader_photo && Storage::disk('public')->exists($project->leader_photo)) {
        Storage::disk('public')->delete($project->leader_photo);
      }  
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
