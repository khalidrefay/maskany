<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('status', 'open')
            ->with(['user'])
            ->latest()
            ->paginate(10);
        // dd($projects);
        return view('consultant.available-projects', compact('projects'));
    }

    public function show(Project $project)
    {
        $project->load(['user']);
        return view('consultant.project-details', compact('project'));
    }
}
