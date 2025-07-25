<?php
//ProjectController.php
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
    public function finalDeliveryForm($projectId)
{
    $proposal = ProjectProposal::where('project_id', $projectId)
                ->where('consultant_id', auth()->id())
                ->where('status', 'accepted')
                ->firstOrFail();

    return view('consultant.final_delivery', compact('proposal'));
}

public function submitFinalDelivery(Request $request, $projectId)
{
    $request->validate([
        'final_delivery_files.*' => 'required|file|mimes:pdf,docx,zip',
    ]);

    $proposal = ProjectProposal::where('project_id', $projectId)
                ->where('consultant_id', auth()->id())
                ->where('status', 'accepted')
                ->firstOrFail();

    $uploadedFiles = [];
    if ($request->hasFile('final_delivery_files')) {
        foreach ($request->file('final_delivery_files') as $file) {
            $path = $file->store('final_delivery_files', 'public');
            $uploadedFiles[] = $path;
        }
    }

    $proposal->final_delivery_files = $uploadedFiles;
    $proposal->save();

    return redirect()->route('consultant.projects.details', $projectId)->with('success', 'تم تسليم الملفات النهائية بنجاح.');
}
public function multiProject()
{
    $projects = Project::with([
        'proposals.consultant',
        'contractorOffers.contractor',
        'contractors'
    ])->get();

    return view('project.multi-project', compact('projects'));
}
}
